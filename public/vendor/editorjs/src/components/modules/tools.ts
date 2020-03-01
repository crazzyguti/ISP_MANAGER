import Paragraph from '../tools/paragraph/dist/bundle';
import Module from '../__module';
import _ from '../utils';
import {
  BlockToolConstructable,
  InlineTool,
  InlineToolConstructable, Tool,
  ToolConfig,
  ToolConstructable,
  ToolSettings,
} from '../../../types';
import BoldInlineTool from '../inline-tools/inline-tool-bold';
import ItalicInlineTool from '../inline-tools/inline-tool-italic';
import LinkInlineTool from '../inline-tools/inline-tool-link';
import Stub from '../tools/stub';

/**
 * @module Editor.js Tools Submodule
 *
 * Creates Instances from Plugins and binds external config to the instances
 */

/**
 * Class properties:
 *
 * @typedef {Tools} Tools
 * @property {Tools[]} toolsAvailable - available Tools
 * @property {Tools[]} toolsUnavailable - unavailable Tools
 * @property {object} toolsClasses - all classes
 * @property {object} toolsSettings - Tools settings
 * @property {EditorConfig} config - Editor config
 */
export default class Tools extends Module {

  /**
   * Name of Stub Tool
   * Stub Tool is used to substitute unavailable block Tools and store their data
   * @type {string}
   */
  public stubTool = 'stub';

  /**
   * Returns available Tools
   * @return {Tool[]}
   */
  public get available(): {[name: string]: ToolConstructable} {
    return this.toolsAvailable;
  }

  /**
   * Returns unavailable Tools
   * @return {Tool[]}
   */
  public get unavailable(): {[name: string]: ToolConstructable} {
    return this.toolsUnavailable;
  }

  /**
   * Return Tools for the Inline Toolbar
   * @return {Object} - object of Inline Tool's classes
   */
  public get inline(): {[name: string]: ToolConstructable} {
    if (this._inlineTools) {
      return this._inlineTools;
    }

    const tools = Object.entries(this.available).filter( ([name, tool]) => {
      if (!tool[this.INTERNAL_SETTINGS.IS_INLINE]) {
        return false;
      }

      /**
       * Some Tools validation
       */
      const inlineToolRequiredMethods = ['render', 'surround', 'checkState'];
      const notImplementedMethods = inlineToolRequiredMethods.filter( (method) => !this.constructInline(tool)[method]);

      if (notImplementedMethods.length) {
        _.log(
          `Incorrect Inline Tool: ${tool.name}. Some of required methods is not implemented %o`,
          'warn',
          notImplementedMethods,
        );
        return false;
      }

      return true;
    });

    /**
     * collected inline tools with key of tool name
     */
    const result = {};

    tools.forEach(([name, tool]) => result[name] = tool);

    /**
     * Cache prepared Tools
     */
    this._inlineTools = result;

    return this._inlineTools;
  }

  /**
   * Return editor block tools
   */
  public get blockTools(): {[name: string]: BlockToolConstructable} {
    // eslint-disable-next-line no-unused-vars
    const tools = Object.entries(this.available).filter( ([name, tool]) => {
      return !tool[this.INTERNAL_SETTINGS.IS_INLINE];
    });

    /**
     * collected block tools with key of tool name
     */
    const result = {};

    tools.forEach(([name, tool]) => result[name] = tool);

    return result;
  }

  /**
   * Constant for available Tools internal settings provided by Tool developer
   *
   * @return {object}
   */
  public get INTERNAL_SETTINGS() {
    return {
      IS_ENABLED_LINE_BREAKS: 'enableLineBreaks',
      IS_INLINE: 'isInline',
      SHORTCUT: 'shortcut',
      TOOLBOX: 'toolbox',
      SANITIZE_CONFIG: 'sanitize',
      CONVERSION_CONFIG: 'conversionConfig',
    };
  }

  /**
   * Constant for available Tools settings provided by user
   *
   * return {object}
   */
  public get USER_SETTINGS() {
    return {
      SHORTCUT: 'shortcut',
      TOOLBOX: 'toolbox',
      ENABLED_INLINE_TOOLS: 'inlineToolbar',
      CONFIG: 'config',
    };
  }

  /**
   * Map {name: Class, ...} where:
   *  name — block type name in JSON. Got from EditorConfig.tools keys
   * @type {Object}
   */
  public readonly toolsClasses: {[name: string]: ToolConstructable} = {};

  /**
   * Tools` classes available to use
   */
  private readonly toolsAvailable: {[name: string]: ToolConstructable} = {};

  /**
   * Tools` classes not available to use because of preparation failure
   */
  private readonly toolsUnavailable: {[name: string]: ToolConstructable} = {};

  /**
   * Tools settings in a map {name: settings, ...}
   * @type {Object}
   */
  private readonly toolsSettings: {[name: string]: ToolSettings} = {};

  /**
   * Cache for the prepared inline tools
   * @type {null|object}
   * @private
   */
  private _inlineTools: {[name: string]: ToolConstructable} = {};

  /**
   * @constructor
   *
   * @param {EditorConfig} config
   */
  constructor({config}) {
    super({config});

    this.toolsClasses = {};

    this.toolsSettings = {};

    /**
     * Available tools list
     * {name: Class, ...}
     * @type {Object}
     */
    this.toolsAvailable = {};

    /**
     * Tools that rejected a prepare method
     * {name: Class, ... }
     * @type {Object}
     */
    this.toolsUnavailable = {};

    this._inlineTools = null;
  }

  /**
   * Creates instances via passed or default configuration
   * @return {Promise}
   */
  public prepare() {
    this.validateTools();

    /**
     * Assign internal tools
     */
    this.config.tools = _.deepMerge({}, this.internalTools, this.config.tools);

    if (!this.config.hasOwnProperty('tools') || Object.keys(this.config.tools).length === 0) {
      throw Error('Can\'t start without tools');
    }

    /**
     * Save Tools settings to a map
     */
    for (const toolName in this.config.tools) {
      /**
       * If Tool is an object not a Tool's class then
       * save class and settings separately
       */
      if (typeof this.config.tools[toolName] === 'object') {
        /**
         * Save Tool's class from 'class' field
         * @type {Tool}
         */
        this.toolsClasses[toolName] = (this.config.tools[toolName] as ToolSettings).class;

        /**
         * Save Tool's settings
         * @type {ToolSettings}
         */
        this.toolsSettings[toolName] = this.config.tools[toolName] as ToolSettings;

        /**
         * Remove Tool's class from settings
         */
        delete this.toolsSettings[toolName].class;
      } else {
        /**
         * Save Tool's class
         * @type {Tool}
         */
        this.toolsClasses[toolName] = this.config.tools[toolName] as ToolConstructable;

        /**
         * Set empty settings for Block by default
         * @type {{}}
         */
        this.toolsSettings[toolName] = {class: this.config.tools[toolName] as ToolConstructable};
      }
    }

    /**
     * getting classes that has prepare method
     */
    const sequenceData = this.getListOfPrepareFunctions();

    /**
     * if sequence data contains nothing then resolve current chain and run other module prepare
     */
    if (sequenceData.length === 0) {
      return Promise.resolve();
    }

    /**
     * to see how it works {@link Util#sequence}
     */
    return _.sequence(sequenceData, (data: any) => {
      this.success(data);
    }, (data) => {
      this.fallback(data);
    });
  }

  /**
   * @param {ChainData.data} data - append tool to available list
   */
  public success(data) {
    this.toolsAvailable[data.toolName] = this.toolsClasses[data.toolName];
  }

  /**
   * @param {ChainData.data} data - append tool to unavailable list
   */
  public fallback(data) {
    this.toolsUnavailable[data.toolName] = this.toolsClasses[data.toolName];
  }

  /**
   * Return Tool`s instance
   *
   * @param {String} tool — tool name
   * @param {BlockToolData} data — initial data
   * @return {BlockTool}
   */
  public construct(tool, data) {
    const plugin = this.toolsClasses[tool];

    /**
     * Configuration to be passed to the Tool's constructor
     */
    const config = this.toolsSettings[tool][this.USER_SETTINGS.CONFIG] || {};

    // Pass placeholder to initial Block config
    if (tool === this.config.initialBlock && !config.placeholder) {
      config.placeholder = this.config.placeholder;
    }

    /**
     * @type {{api: API, config: ({}), data: BlockToolData}}
     */
    const constructorOptions = {
      api: this.Editor.API.methods,
      config,
      data,
    };

    return new plugin(constructorOptions);
  }

  /**
   * Return Inline Tool's instance
   *
   * @param {InlineTool} tool
   * @param {ToolSettings} toolSettings
   * @return {InlineTool} — instance
   */
  public constructInline(tool: InlineToolConstructable, toolSettings: ToolSettings = {} as ToolSettings): InlineTool {
    /**
     * @type {{api: API}}
     */
    const constructorOptions = {
      api: this.Editor.API.methods,
      config: (toolSettings[this.USER_SETTINGS.CONFIG] || {}) as ToolSettings,
    };

    return new tool(constructorOptions) as InlineTool;
  }

  /**
   * Check if passed Tool is an instance of Initial Block Tool
   * @param {Tool} tool - Tool to check
   * @return {Boolean}
   */
  public isInitial(tool) {
    return tool instanceof this.available[this.config.initialBlock];
  }

  /**
   * Return Tool's config by name
   * @param {string} toolName
   * @return {ToolSettings}
   */
  public getToolSettings(toolName): ToolSettings {
    return this.toolsSettings[toolName];
  }

  /**
   * Binds prepare function of plugins with user or default config
   * @return {Array} list of functions that needs to be fired sequentially
   */
  private getListOfPrepareFunctions(): Array<{
    function: (data: {toolName: string, config: ToolConfig}) => void,
    data: {toolName: string, config: ToolConfig},
  }> {
    const toolPreparationList: Array<{
      function: (data: {toolName: string, config: ToolConfig}) => void,
      data: {toolName: string, config: ToolConfig}}
      > = [];

    for (const toolName in this.toolsClasses) {
      if (this.toolsClasses.hasOwnProperty(toolName)) {
        const toolClass = this.toolsClasses[toolName];

        if (typeof toolClass.prepare === 'function') {
          toolPreparationList.push({
            function: toolClass.prepare,
            data: {
              toolName,
              config: this.toolsSettings[toolName][this.USER_SETTINGS.CONFIG],
            },
          });
        } else {
          /**
           * If Tool hasn't a prepare method, mark it as available
           */
          this.toolsAvailable[toolName] = toolClass;
        }
      }
    }

    return toolPreparationList;
  }

  /**
   * Validate Tools configuration objects and throw Error for user if it is invalid
   */
  private validateTools() {
    /**
     * Check Tools for a class containing
     */
    for (const toolName in this.config.tools) {
      if (this.config.tools.hasOwnProperty(toolName)) {
        if (toolName in this.internalTools) {
          return;
        }

        const tool = this.config.tools[toolName];

        if (!_.isFunction(tool) && !_.isFunction((tool as ToolSettings).class)) {
          throw Error(
            `Tool «${toolName}» must be a constructor function or an object with function in the «class» property`,
          );
        }
      }
    }
  }

  /**
   * Returns internal tools
   * Includes Bold, Italic, Link and Paragraph
   */
  get internalTools() {
    return {
      bold: {class: BoldInlineTool},
      italic: {class: ItalicInlineTool},
      link: {class: LinkInlineTool},
      paragraph: {
        class: Paragraph,
        inlineToolbar: true,
      },
      stub: {class: Stub},
    };
  }
}
