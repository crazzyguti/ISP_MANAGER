import $ from './dom';
import _ from './utils';
import {EditorConfig, OutputData, SanitizerConfig} from '../../types';
import {EditorModules} from '../types-internal/editor-modules';

/**
 * @typedef {Core} Core - editor core class
 */

/**
 * Require Editor modules places in components/modules dir
 */
const contextRequire = require.context('./modules', true);

const modules = [];

contextRequire.keys().forEach((filename) => {
  /**
   * Include files if:
   * - extension is .js or .ts
   * - does not starts with _
   */
  if (filename.match(/^\.\/[^_][\w/]*\.([tj])s$/)) {
    modules.push(contextRequire(filename));
  }
});

/**
 * @class Core
 *
 * @classdesc Editor.js core class
 *
 * @property this.config - all settings
 * @property this.moduleInstances - constructed editor components
 *
 * @type {Core}
 */
export default class Core {

  /**
   * Editor configuration passed by user to the constructor
   */
  public config: EditorConfig;

  /**
   * Object with core modules instances
   */
  public moduleInstances: EditorModules = {} as EditorModules;

  /**
   * Promise that resolves when all core modules are prepared and UI is rendered on the page
   */
  public isReady: Promise<void>;

  /**
   * @param {EditorConfig} config - user configuration
   *
   */
  constructor(config?: EditorConfig|string) {
    /**
     * Ready promise. Resolved if Editor.js is ready to work, rejected otherwise
     */
    let onReady, onFail;

    this.isReady = new Promise((resolve, reject) => {
      onReady = resolve;
      onFail = reject;
    });

    Promise.resolve()
      .then(async () => {
        this.configuration = config;

        await this.validate();
        await this.init();
        await this.start();

        _.log('I\'m ready! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧', 'log', '', 'color: #E24A75');

        setTimeout(() => {
          if ((this.configuration as EditorConfig).autofocus) {
            const {BlockManager, Caret} = this.moduleInstances;

            Caret.setToBlock(BlockManager.blocks[0], Caret.positions.START);
          }

          /**
           * Remove loader, show content
           */
          this.moduleInstances.UI.removeLoader();

          /**
           * Resolve this.isReady promise
           */
          onReady();
        }, 500);
      })
      .catch((error) => {
        _.log(`Editor.js is not ready because of ${error}`, 'error');

        /**
         * Reject this.isReady promise
         */
        onFail(error);
      });
  }

  /**
   * Setting for configuration
   * @param {EditorConfig|string|undefined} config
   */
  set configuration(config: EditorConfig|string) {
    /**
     * Process zero-configuration or with only holderId
     * Make config object
     */
    if (typeof config !== 'object') {
      config = {
        holder: config,
      };
    }

    /**
     * If holderId is preset, assign him to holder property and work next only with holder
     */
    if (config.holderId && !config.holder) {
      config.holder = config.holderId;
      config.holderId = null;
      _.log('holderId property will deprecated in next major release, use holder property instead.', 'warn');
    }

    /**
     * Place config into the class property
     * @type {EditorConfig}
     */
    this.config = config;

    /**
     * If holder is empty then set a default value
     */
    if (this.config.holder == null) {
      this.config.holder = 'editorjs';
    }

    /**
     * If initial Block's Tool was not passed, use the Paragraph Tool
     */
    this.config.initialBlock = this.config.initialBlock || 'paragraph';

    /**
     * Height of Editor's bottom area that allows to set focus on the last Block
     * @type {number}
     */
    this.config.minHeight = this.config.minHeight || 300;

    /**
     * Initial block type
     * Uses in case when there is no blocks passed
     * @type {{type: (*), data: {text: null}}}
     */
    const initialBlockData = {
      type : this.config.initialBlock,
      data : {},
    };

    this.config.placeholder = this.config.placeholder || false;
    this.config.sanitizer = this.config.sanitizer || {
      p: true,
      b: true,
      a: true,
    } as SanitizerConfig;

    this.config.hideToolbar = this.config.hideToolbar ? this.config.hideToolbar : false;
    this.config.tools = this.config.tools || {};
    this.config.data = this.config.data || {} as OutputData;
    this.config.onReady = this.config.onReady || (() => {});
    this.config.onChange = this.config.onChange || (() => {});

    /**
     * Initialize Blocks to pass data to the Renderer
     */
    if (_.isEmpty(this.config.data)) {
      this.config.data = {} as OutputData;
      this.config.data.blocks = [ initialBlockData ];
    } else {
      if (!this.config.data.blocks || this.config.data.blocks.length === 0) {
        this.config.data.blocks = [ initialBlockData ];
      }
    }
  }

  /**
   * Returns private property
   * @returns {EditorConfig}
   */
  get configuration(): EditorConfig|string {
    return this.config;
  }

  /**
   * Checks for required fields in Editor's config
   * @returns {Promise<void>}
   */
  public async validate(): Promise<void> {
    const { holderId, holder } = this.config;

    if (holderId && holder) {
      throw Error('«holderId» and «holder» param can\'t assign at the same time.');
    }

    /**
     * Check for a holder element's existence
     */
    if (typeof holder === 'string' && !$.get(holder)) {
      throw Error(`element with ID «${holder}» is missing. Pass correct holder's ID.`);
    }

    if (holder && typeof holder === 'object' && !$.isElement(holder)) {
      throw Error('holder as HTMLElement if provided must be inherit from Element class.');
    }
  }

  /**
   * Initializes modules:
   *  - make and save instances
   *  - configure
   */
  public init() {
    /**
     * Make modules instances and save it to the @property this.moduleInstances
     */
    this.constructModules();

    /**
     * Modules configuration
     */
    this.configureModules();
  }

  /**
   * Start Editor!
   *
   * Get list of modules that needs to be prepared and return a sequence (Promise)
   * @return {Promise}
   */
  public async start() {
    const modulesToPrepare = [
      'Tools',
      'UI',
      'BlockManager',
      'Paste',
      'DragNDrop',
      'ModificationsObserver',
      'BlockSelection',
      'RectangleSelection',
    ];

    await modulesToPrepare.reduce(
      (promise, module) => promise.then(async () => {
        // _.log(`Preparing ${module} module`, 'time');

        try {
          await this.moduleInstances[module].prepare();
        } catch (e) {
          _.log(`Module ${module} was skipped because of %o`, 'warn', e);
        }
        // _.log(`Preparing ${module} module`, 'timeEnd');
      }),
      Promise.resolve(),
    );

    return this.moduleInstances.Renderer.render(this.config.data.blocks);
  }

  /**
   * Make modules instances and save it to the @property this.moduleInstances
   */
  private constructModules(): void {
    modules.forEach( (Module) => {
      try {
        /**
         * We use class name provided by displayName property
         *
         * On build, Babel will transform all Classes to the Functions so, name will always be 'Function'
         * To prevent this, we use 'babel-plugin-class-display-name' plugin
         * @see  https://www.npmjs.com/package/babel-plugin-class-display-name
         */
        this.moduleInstances[Module.displayName] = new Module({
          config : this.configuration,
        });
      } catch ( e ) {
        _.log(`Module ${Module.displayName} skipped because`, 'warn',  e);
      }
    });
  }

  /**
   * Modules instances configuration:
   *  - pass other modules to the 'state' property
   *  - ...
   */
  private configureModules(): void {
    for (const name in this.moduleInstances) {
      if (this.moduleInstances.hasOwnProperty(name)) {
        /**
         * Module does not need self-instance
         */
        this.moduleInstances[name].state = this.getModulesDiff(name);
      }
    }
  }

  /**
   * Return modules without passed name
   * @param {string} name - module for witch modules difference should be calculated
   */
  private getModulesDiff(name: string): EditorModules {
    const diff = {} as EditorModules;

    for (const moduleName in this.moduleInstances) {
      /**
       * Skip module with passed name
       */
      if (moduleName === name) {
        continue;
      }
      diff[moduleName] = this.moduleInstances[moduleName];
    }

    return diff;
  }
}
