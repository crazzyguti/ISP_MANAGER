import Module from '../../__module';
import $ from '../../dom';
import {BlockToolConstructable} from '../../../../types';
import _ from '../../utils';
import {SavedData} from '../../../types-internal/block-data';
import Block from '../../block';
import Flipper from '../../flipper';

/**
 * Block Converter
 */
export default class ConversionToolbar extends Module {
  /**
   * CSS getter
   */
  public static get CSS(): { [key: string]: string } {
    return {
      conversionToolbarWrapper: 'ce-conversion-toolbar',
      conversionToolbarShowed: 'ce-conversion-toolbar--showed',
      conversionToolbarTools: 'ce-conversion-toolbar__tools',
      conversionTool: 'ce-conversion-tool',

      conversionToolFocused : 'ce-conversion-tool--focused',
      conversionToolActive : 'ce-conversion-tool--active',
    };
  }

  /**
   * HTML Elements used for UI
   */
  public nodes: { [key: string]: HTMLElement } = {
    wrapper: null,
    tools: null,
  };

  /**
   * Conversion Toolbar open/close state
   * @type {boolean}
   */
  public opened: boolean = false;

  /**
   * Available tools
   */
  private tools: { [key: string]: HTMLElement } = {};

  /**
   * Instance of class that responses for leafing buttons by arrows/tab
   * @type {Flipper|null}
   */
  private flipper: Flipper = null;

  /**
   * Create UI of Conversion Toolbar
   */
  public make(): void {
    this.nodes.wrapper = $.make('div', ConversionToolbar.CSS.conversionToolbarWrapper);
    this.nodes.tools = $.make('div', ConversionToolbar.CSS.conversionToolbarTools);

    /**
     * Add Tools that has 'import' method
     */
    this.addTools();

    /**
     * Prepare Flipper to be able to leaf tools by arrows/tab
     */
    this.enableFlipper();

    $.append(this.nodes.wrapper, this.nodes.tools);
    $.append(this.Editor.UI.nodes.wrapper, this.nodes.wrapper);
  }

  /**
   * Try to show Conversion Toolbar near passed Block
   * @param {Block} block - block to convert
   */
  public tryToShow(block: Block): void {
    const hasExportConfig = block.class.conversionConfig && block.class.conversionConfig.export;

    if (!hasExportConfig) {
      return;
    }

    this.move(block);

    if (!this.opened) {
      this.open();
    }

    /**
     * Mark current block's button with color
     */
    this.highlightActiveTool(block.name);
  }

  /**
   * Shows Conversion Toolbar
   */
  public open(): void {
    this.opened = true;
    this.flipper.activate(Object.values(this.tools));
    this.flipper.focusFirst();
    this.nodes.wrapper.classList.add(ConversionToolbar.CSS.conversionToolbarShowed);
  }

  /**
   * Closes Conversion Toolbar
   */
  public close(): void {
    this.opened = false;
    this.flipper.deactivate();
    this.nodes.wrapper.classList.remove(ConversionToolbar.CSS.conversionToolbarShowed);
  }

  /**
   * Replaces one Block with another
   * For that Tools must provide import/export methods
   *
   * @param {string} replacingToolName
   */
  public async replaceWithBlock(replacingToolName: string): Promise <void> {
    /**
     * At first, we get current Block data
     * @type {BlockToolConstructable}
     */
    const currentBlockClass = this.Editor.BlockManager.currentBlock.class;
    const currentBlockName = this.Editor.BlockManager.currentBlock.name;
    const savedBlock = await this.Editor.BlockManager.currentBlock.save() as SavedData;
    const blockData = savedBlock.data;

    /**
     * When current Block name is equals to the replacing tool Name,
     * than convert this Block back to the initial Block
     */
    if (currentBlockName === replacingToolName) {
      replacingToolName = this.config.initialBlock;
    }

    /**
     * Getting a class of replacing Tool
     * @type {BlockToolConstructable}
     */
    const replacingTool = this.Editor.Tools.toolsClasses[replacingToolName] as BlockToolConstructable;

    /**
     * Export property can be:
     * 1) Function — Tool defines which data to return
     * 2) String — the name of saved property
     *
     * In both cases returning value must be a string
     */
    let exportData: string = '';
    const exportProp = currentBlockClass.conversionConfig.export;

    if (typeof exportProp === 'function') {
      exportData = exportProp(blockData);
    } else if (typeof exportProp === 'string') {
      exportData = blockData[exportProp];
    } else {
      _.log('Conversion «export» property must be a string or function. ' +
        'String means key of saved data object to export. Function should export processed string to export.');
      return;
    }

    /**
     * Clean exported data with replacing sanitizer config
     */
    const cleaned: string = this.Editor.Sanitizer.clean(
      exportData,
      replacingTool.sanitize,
    );

    /**
     * «import» property can be Function or String
     * function — accept imported string and compose tool data object
     * string — the name of data field to import
     */
    let newBlockData = {};
    const importProp = replacingTool.conversionConfig.import;

    if (typeof importProp === 'function') {
      newBlockData = importProp(cleaned);
    } else if (typeof importProp === 'string') {
      newBlockData[importProp] = cleaned;
    } else {
      _.log('Conversion «import» property must be a string or function. ' +
        'String means key of tool data to import. Function accepts a imported string and return composed tool data.');
      return;
    }

    this.Editor.BlockManager.replace(replacingToolName, newBlockData);
    this.Editor.BlockSelection.clearSelection();

    this.close();

    _.delay(() => {
      this.Editor.Caret.setToBlock(this.Editor.BlockManager.currentBlock);
    }, 10)();
  }

  /**
   * Move Conversion Toolbar to the working Block
   */
  private move(block: Block): void {
    const blockRect = block.pluginsContent.getBoundingClientRect();
    const wrapperRect = this.Editor.UI.nodes.wrapper.getBoundingClientRect();

    const newCoords = {
      x: blockRect.left - wrapperRect.left,
      y: blockRect.top + blockRect.height - wrapperRect.top,
    };

    this.nodes.wrapper.style.left = Math.floor(newCoords.x) + 'px';
    this.nodes.wrapper.style.top = Math.floor(newCoords.y) + 'px';
  }

  /**
   * Iterates existing Tools and inserts to the ConversionToolbar
   * if tools have ability to import
   */
  private addTools(): void {
    const tools = this.Editor.Tools.blockTools;

    for (const toolName in tools) {
      if (!tools.hasOwnProperty(toolName)) {
        continue;
      }

      const internalSettings = this.Editor.Tools.INTERNAL_SETTINGS;
      const toolClass = tools[toolName] as BlockToolConstructable;
      const toolToolboxSettings = toolClass[internalSettings.TOOLBOX];
      const conversionConfig = toolClass[internalSettings.CONVERSION_CONFIG];

      /**
       * Skip tools that don't pass 'toolbox' property
       */
      if (_.isEmpty(toolToolboxSettings) || !toolToolboxSettings.icon) {
        continue;
      }

      /**
       * Skip tools without «import» rule specified
       */
      if (!conversionConfig || !conversionConfig.import) {
        continue;
      }

      this.addTool(toolName, toolToolboxSettings.icon);
    }
  }

  /**
   * Add tool to the Conversion Toolbar
   */
  private addTool(toolName: string, toolIcon: string): void {
    const tool = $.make('div', [ ConversionToolbar.CSS.conversionTool ]);

    tool.dataset.tool = toolName;
    tool.innerHTML = toolIcon;

    $.append(this.nodes.tools, tool);
    this.tools[toolName] = tool;

    this.Editor.Listeners.on(tool, 'click', async () => {
      await this.replaceWithBlock(toolName);
    });
  }

  /**
   * Marks current Blocks button with highlighting color
   */
  private highlightActiveTool(toolName: string): void {
    if (!this.tools[toolName]) {
      return;
    }

    /**
     * Drop previous active button
     */
    Object.values(this.tools).forEach((el) => {
      el.classList.remove(ConversionToolbar.CSS.conversionToolActive);
    });

    this.tools[toolName].classList.add(ConversionToolbar.CSS.conversionToolActive);
  }

  /**
   * Prepare Flipper to be able to leaf tools by arrows/tab
   */
  private enableFlipper(): void {
    this.flipper = new Flipper({
      focusedItemClass: ConversionToolbar.CSS.conversionToolFocused,
    });
  }
}
