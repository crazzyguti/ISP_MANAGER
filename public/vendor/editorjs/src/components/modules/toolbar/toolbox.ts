import Module from '../../__module';
import $ from '../../dom';
import _ from '../../utils';
import {BlockToolConstructable} from '../../../../types';
import Flipper from '../../flipper';

/**
 * @class Toolbox
 * @classdesc Holder for Tools
 *
 * @typedef {Toolbox} Toolbox
 * @property {Boolean} opened - opening state
 * @property {Object} nodes   - Toolbox nodes
 * @property {Object} CSS     - CSS class names
 *
 */
export default class Toolbox extends Module {

  /**
   * CSS styles
   * @return {{toolbox: string, toolboxButton string, toolboxButtonActive: string,
   * toolboxOpened: string, tooltip: string, tooltipShown: string, tooltipShortcut: string}}
   */
  get CSS() {
    return  {
      toolbox: 'ce-toolbox',
      toolboxButton: 'ce-toolbox__button',
      toolboxButtonActive : 'ce-toolbox__button--active',
      toolboxOpened: 'ce-toolbox--opened',
      tooltip: 'ce-toolbox__tooltip',
      tooltipShown: 'ce-toolbox__tooltip--shown',
      tooltipShortcut: 'ce-toolbox__tooltip-shortcut',
      openedToolbarHolderModifier: 'codex-editor--toolbox-opened',
    };
  }

  /**
   * Returns True if Toolbox is Empty and nothing to show
   * @return {boolean}
   */
  public get isEmpty(): boolean {
    return this.displayedToolsCount === 0;
  }

  /**
   * Opening state
   * @type {boolean}
   */
  public opened: boolean = false;

  /**
   * HTMLElements used for Toolbox UI
   */
  public nodes: {
    toolbox: HTMLElement,
    tooltip: HTMLElement,
    buttons: HTMLElement[],
  } = {
    toolbox: null,
    tooltip: null,
    buttons: [],
  };

  /**
   * How many tools displayed in Toolbox
   * @type {number}
   */
  private displayedToolsCount: number = 0;

  /**
   * Instance of class that responses for leafing buttons by arrows/tab
   * @type {Flipper|null}
   */
  private flipper: Flipper = null;

  /**
   * Makes the Toolbox
   */
  public make(): void {
    this.nodes.toolbox = $.make('div', this.CSS.toolbox);
    $.append(this.Editor.Toolbar.nodes.content, this.nodes.toolbox);

    this.addTools();
    this.addTooltip();
    this.enableFlipper();
  }

  /**
   * Toolbox Tool's button click handler
   *
   * @param {MouseEvent|KeyboardEvent} event
   * @param {string} toolName
   */
  public toolButtonActivate(event: MouseEvent|KeyboardEvent, toolName: string): void {
    const tool = this.Editor.Tools.toolsClasses[toolName] as BlockToolConstructable;

    this.insertNewBlock(tool, toolName);
  }

  /**
   * Open Toolbox with Tools
   */
  public open(): void {
    if (this.isEmpty) {
      return;
    }

    this.Editor.UI.nodes.wrapper.classList.add(this.CSS.openedToolbarHolderModifier);
    this.nodes.toolbox.classList.add(this.CSS.toolboxOpened);

    this.opened = true;
    this.flipper.activate();
  }

  /**
   * Close Toolbox
   */
  public close(): void {
    this.hideTooltip();

    this.nodes.toolbox.classList.remove(this.CSS.toolboxOpened);
    this.Editor.UI.nodes.wrapper.classList.remove(this.CSS.openedToolbarHolderModifier);

    this.opened = false;
    this.flipper.deactivate();
  }

  /**
   * Close Toolbox
   */
  public toggle(): void {
    if (!this.opened) {
      this.open();
    } else {
      this.close();
    }
  }

  /**
   * Hide toolbox tooltip
   */
  public hideTooltip(): void {
    this.nodes.tooltip.classList.remove(this.CSS.tooltipShown);
  }

  /**
   * Iterates available tools and appends them to the Toolbox
   */
  private addTools(): void {
    const tools = this.Editor.Tools.available;

    for (const toolName in tools) {
      if (tools.hasOwnProperty(toolName)) {
        this.addTool(toolName, tools[toolName]  as BlockToolConstructable);
      }
    }
  }

  /**
   * Append Tool to the Toolbox
   *
   * @param {string} toolName - tool name
   * @param {BlockToolConstructable} tool - tool class
   */
  private addTool(toolName: string, tool: BlockToolConstructable): void {
    const internalSettings = this.Editor.Tools.INTERNAL_SETTINGS;
    const userSettings = this.Editor.Tools.USER_SETTINGS;

    const toolToolboxSettings = tool[internalSettings.TOOLBOX];

    /**
     * Skip tools that don't pass 'toolbox' property
     */
    if (_.isEmpty(toolToolboxSettings)) {
      return;
    }

    if (toolToolboxSettings && !toolToolboxSettings.icon) {
      _.log('Toolbar icon is missed. Tool %o skipped', 'warn', toolName);
      return;
    }

    /**
     * @todo Add checkup for the render method
     */
    // if (typeof tool.render !== 'function') {
    //   _.log('render method missed. Tool %o skipped', 'warn', tool);
    //   return;
    // }

    const userToolboxSettings = this.Editor.Tools.getToolSettings(toolName)[userSettings.TOOLBOX] || {};

    const button = $.make('li', [ this.CSS.toolboxButton ]);

    button.dataset.tool = toolName;
    button.innerHTML = userToolboxSettings.icon || toolToolboxSettings.icon;

    $.append(this.nodes.toolbox, button);

    this.nodes.toolbox.appendChild(button);
    this.nodes.buttons.push(button);

    /**
     * Add click listener
     */
    this.Editor.Listeners.on(button, 'click', (event: KeyboardEvent|MouseEvent) => {
      this.toolButtonActivate(event, toolName);
    });

    /**
     * Add listeners to show/hide toolbox tooltip
     */
    this.Editor.Listeners.on(button, 'mouseenter', () => {
      this.showTooltip(button, toolName);
    });

    this.Editor.Listeners.on(button, 'mouseleave', () => {
      this.hideTooltip();
    });

    /**
     * Enable shortcut
     */
    const toolSettings = this.Editor.Tools.getToolSettings(toolName);

    if (toolSettings && toolSettings[this.Editor.Tools.USER_SETTINGS.SHORTCUT]) {
      this.enableShortcut(tool, toolName, toolSettings[this.Editor.Tools.USER_SETTINGS.SHORTCUT]);
    }

    /** Increment Tools count */
    this.displayedToolsCount++;
  }

  /**
   * Add toolbox tooltip to page
   */
  private addTooltip(): void {
    this.nodes.tooltip = $.make('div', this.CSS.tooltip, {
      innerHTML: '',
    });

    $.append(this.Editor.Toolbar.nodes.content, this.nodes.tooltip);
  }

  /**
   * Show tooltip for toolbox button
   * @param {HTMLElement} button
   * @param {string} toolName
   */
  private showTooltip(button: HTMLElement, toolName: string): void {
    const toolSettings = this.Editor.Tools.getToolSettings(toolName);
    const toolboxSettings = this.Editor.Tools.available[toolName][this.Editor.Tools.INTERNAL_SETTINGS.TOOLBOX] || {};
    const userToolboxSettings = toolSettings.toolbox || {};
    const name = userToolboxSettings.title || toolboxSettings.title || toolName;

    let shortcut = toolSettings[this.Editor.Tools.USER_SETTINGS.SHORTCUT];

    const fragment = document.createDocumentFragment();
    const hint = document.createTextNode(_.capitalize(name));

    fragment.appendChild(hint);

    if (shortcut) {
      const OS = _.getUserOS();

      shortcut = shortcut
        .replace(/shift/gi, '⇧')
        .replace(/backspace/gi, '⌫')
        .replace(/enter/gi, '⏎')
        .replace(/up/gi, '↑')
        .replace(/left/gi, '→')
        .replace(/down/gi, '↓')
        .replace(/right/gi, '←')
        .replace(/escape/gi, '⎋')
        .replace(/insert/gi, 'Ins')
        .replace(/delete/gi, '␡')
        .replace(/\+/gi, ' + ');

      if (OS.mac) {
        shortcut = shortcut.replace(/ctrl|cmd/gi, '⌘').replace(/alt/gi, '⌥');
      } else {
        shortcut = shortcut.replace(/cmd/gi, 'Ctrl').replace(/windows/gi, 'WIN');
      }

      fragment.appendChild($.make('div', this.CSS.tooltipShortcut, {
        textContent: shortcut,
      }));
    }

    const leftOffset = 16;
    const coordinate = button.offsetLeft;
    const topOffset = Math.floor(this.Editor.BlockManager.currentBlock.holder.offsetHeight / 2);

    this.nodes.tooltip.innerHTML = '';
    this.nodes.tooltip.appendChild(fragment);

    this.nodes.tooltip.style.left = `${coordinate + leftOffset}px`;
    this.nodes.tooltip.style.transform = `translate3d(-50%, ${topOffset}px, 0)`;
    this.nodes.tooltip.classList.add(this.CSS.tooltipShown);
  }

  /**
   * Enable shortcut Block Tool implemented shortcut
   * @param {BlockToolConstructable} tool - Tool class
   * @param {String} toolName - Tool name
   * @param {String} shortcut - shortcut according to the ShortcutData Module format
   */
  private enableShortcut(tool: BlockToolConstructable, toolName: string, shortcut: string) {
    this.Editor.Shortcuts.add({
      name: shortcut,
      handler: (event: KeyboardEvent) => {
        event.preventDefault();
        this.insertNewBlock(tool, toolName);
      },
    });
  }

  /**
   * Creates Flipper instance to be able to leaf tools
   */
  private enableFlipper(): void {
    const tools = Array.from(this.nodes.toolbox.childNodes) as HTMLElement[];
    this.flipper = new Flipper({
      items: tools,
      focusedItemClass: this.CSS.toolboxButtonActive,
    });
  }

  /**
   * Inserts new block
   * Can be called when button clicked on Toolbox or by ShortcutData
   *
   * @param {BlockToolConstructable} tool - Tool Class
   * @param {String} toolName - Tool name
   */
  private insertNewBlock(tool: BlockToolConstructable, toolName: string) {
    const {BlockManager, Caret} = this.Editor;
    /**
     * @type {Block}
     */
    const {currentBlock} = BlockManager;

    let newBlock;

    if (currentBlock.isEmpty) {
      newBlock = BlockManager.replace(toolName);
    } else {
      newBlock = BlockManager.insert(toolName);
    }

    /**
     * Apply callback before inserting html
     */
    newBlock.call('appendCallback', {});

    this.Editor.Caret.setToBlock(newBlock);

    /** If new block doesn't contain inpus, insert new paragraph above */
    if (newBlock.inputs.length === 0) {
      if (newBlock === BlockManager.lastBlock) {
        BlockManager.insertAtEnd();
        Caret.setToBlock(BlockManager.lastBlock);
      } else {
        Caret.setToBlock(BlockManager.nextBlock);
      }
    }

    /**
     * close toolbar when node is changed
     */
    this.Editor.Toolbar.close();
  }
}
