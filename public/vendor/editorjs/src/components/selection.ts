/**
 * TextRange interface fot IE9-
 */
import _ from './utils';
import $ from './dom';

interface TextRange {
  boundingTop: number;
  boundingLeft: number;
  boundingBottom: number;
  boundingRight: number;
  boundingHeight: number;
  boundingWidth: number;
}

/**
 * Interface for object returned by document.selection in IE9-
 */
interface MSSelection {
  createRange: () => TextRange;
  type: string;
}

/**
 * Extends Document interface for IE9-
 */
interface Document {
  selection?: MSSelection;
}

/**
 * Working with selection
 * @typedef {SelectionUtils} SelectionUtils
 */
export default class SelectionUtils {

  /**
   * Editor styles
   * @return {{editorWrapper: string, editorZone: string}}
   */
  static get CSS(): { editorWrapper: string, editorZone: string } {
    return {
      editorWrapper: 'codex-editor',
      editorZone: 'codex-editor__redactor',
    };
  }

  /**
   * Returns selected anchor
   * {@link https://developer.mozilla.org/ru/docs/Web/API/Selection/anchorNode}
   * @return {Node|null}
   */
  static get anchorNode(): Node | null {
    const selection = window.getSelection();

    return selection ? selection.anchorNode : null;
  }

  /**
   * Returns selected anchor element
   * @return {Element|null}
   */
  static get anchorElement(): Element | null {
    const selection = window.getSelection();

    if (!selection) {
      return null;
    }

    const anchorNode = selection.anchorNode;

    if (!anchorNode) {
      return null;
    }

    if (!$.isElement(anchorNode)) {
      return anchorNode.parentElement;
    } else {
      return anchorNode;
    }
  }

  /**
   * Returns selection offset according to the anchor node
   * {@link https://developer.mozilla.org/ru/docs/Web/API/Selection/anchorOffset}
   * @return {Number|null}
   */
  static get anchorOffset(): number | null {
    const selection = window.getSelection();

    return selection ? selection.anchorOffset : null;
  }

  /**
   * Is current selection range collapsed
   * @return {boolean|null}
   */
  static get isCollapsed(): boolean | null {
    const selection = window.getSelection();

    return selection ? selection.isCollapsed : null;
  }

  /**
   * Returns true if 85% of text content is selected
   * @return {boolean}
   */
  public static almostAllSelected(targetText: string): boolean {
    const range = SelectionUtils.range;

    if (!range) {
      return false;
    }

    const copiedFragment = range.cloneContents();
    const lengthOfWholeText = targetText.length;
    const lengthOfCopiedText = copiedFragment.textContent.length;

    return lengthOfCopiedText / lengthOfWholeText > 0.85;
  }

  /**
   * Check current selection if it is at Editor's zone
   * @return {boolean}
   */
  static get isAtEditor(): boolean {
    const selection = SelectionUtils.get();

    /**
     * Something selected on document
     */
    let selectedNode = (selection.anchorNode || selection.focusNode) as HTMLElement;

    if (selectedNode && selectedNode.nodeType === Node.TEXT_NODE) {
      selectedNode = selectedNode.parentNode as HTMLElement;
    }

    let editorZone = null;
    if (selectedNode) {
      editorZone = selectedNode.closest(`.${SelectionUtils.CSS.editorZone}`);
    }

    /**
     * SelectionUtils is not out of Editor because Editor's wrapper was found
     */
    return editorZone && editorZone.nodeType === Node.ELEMENT_NODE;
  }

  /**
   * Return first range
   * @return {Range|null}
   */
  static get range(): Range {
    const selection = window.getSelection();

    return selection && selection.rangeCount ? selection.getRangeAt(0) : null;
  }

  /**
   * Calculates position and size of selected text
   * @return {{x, y, width, height, top?, left?, bottom?, right?}}
   */
  static get rect(): DOMRect | ClientRect {
    let sel: Selection | MSSelection = (document as Document).selection,
      range: TextRange | Range;

    let rect = {
      x: 0,
      y: 0,
      width: 0,
      height: 0,
    } as DOMRect;

    if (sel && sel.type !== 'Control') {
      sel = sel as MSSelection;
      range = sel.createRange() as TextRange;
      rect.x = range.boundingLeft;
      rect.y = range.boundingTop;
      rect.width = range.boundingWidth;
      rect.height = range.boundingHeight;

      return rect;
    }

    if (!window.getSelection) {
      _.log('Method window.getSelection is not supported', 'warn');
      return rect;
    }

    sel = window.getSelection();

    if (sel.rangeCount === null || isNaN(sel.rangeCount)) {
      _.log('Method SelectionUtils.rangeCount is not supported', 'warn');
      return rect;
    }

    range = sel.getRangeAt(0).cloneRange() as Range;

    if (range.getBoundingClientRect) {
      rect = range.getBoundingClientRect() as DOMRect;
    }
    // Fall back to inserting a temporary element
    if (rect.x === 0 && rect.y === 0) {
      const span = document.createElement('span');

      if (span.getBoundingClientRect) {
        // Ensure span has dimensions and position by
        // adding a zero-width space character
        span.appendChild(document.createTextNode('\u200b'));
        range.insertNode(span);
        rect = span.getBoundingClientRect() as DOMRect;

        const spanParent = span.parentNode;

        spanParent.removeChild(span);

        // Glue any broken text nodes back together
        spanParent.normalize();
      }
    }

    return rect;
  }

  /**
   * Returns selected text as String
   * @returns {string}
   */
  static get text(): string {
    return window.getSelection ? window.getSelection().toString() : '';
  }

  /**
   * Returns window SelectionUtils
   * {@link https://developer.mozilla.org/ru/docs/Web/API/Window/getSelection}
   * @return {Selection}
   */
  public static get(): Selection {
    return window.getSelection();
  }

  public instance: Selection = null;
  public selection: Selection = null;

  /**
   * This property can store SelectionUtils's range for restoring later
   * @type {Range|null}
   */
  public savedSelectionRange: Range = null;

  /**
   * Fake background is active
   *
   * @return {boolean}
   */
  public isFakeBackgroundEnabled = false;

  /**
   * Native Document's commands for fake background
   */
  private readonly commandBackground: string = 'backColor';
  private readonly commandRemoveFormat: string = 'removeFormat';

  /**
   * Removes fake background
   */
  public removeFakeBackground() {
    if (!this.isFakeBackgroundEnabled) {
      return;
    }

    this.isFakeBackgroundEnabled = false;
    document.execCommand(this.commandRemoveFormat);
  }

  /**
   * Sets fake background
   */
  public setFakeBackground() {
    document.execCommand(this.commandBackground, false, '#a8d6ff');

    this.isFakeBackgroundEnabled = true;
  }

  /**
   * Save SelectionUtils's range
   */
  public save(): void {
    this.savedSelectionRange = SelectionUtils.range;
  }

  /**
   * Restore saved SelectionUtils's range
   */
  public restore(): void {
    if (!this.savedSelectionRange) {
      return;
    }

    const sel = window.getSelection();

    sel.removeAllRanges();
    sel.addRange(this.savedSelectionRange);
  }

  /**
   * Clears saved selection
   */
  public clearSaved(): void {
    this.savedSelectionRange = null;
  }

  /**
   * Collapse current selection
   */
  public collapseToEnd(): void {
    const sel = window.getSelection();
    const range = document.createRange();

    range.selectNodeContents(sel.focusNode);
    range.collapse(false);
    sel.removeAllRanges();
    sel.addRange(range);
  }

  /**
   * Looks ahead to find passed tag from current selection
   *
   * @param  {String} tagName       - tag to found
   * @param  {String} [className]   - tag's class name
   * @param  {Number} [searchDepth] - count of tags that can be included. For better performance.
   * @return {HTMLElement|null}
   */
  public findParentTag(tagName: string, className?: string, searchDepth = 10): HTMLElement | null {
    const selection = window.getSelection();
    let parentTag = null;

    /**
     * If selection is missing or no anchorNode or focusNode were found then return null
     */
    if (!selection || !selection.anchorNode || !selection.focusNode) {
      return null;
    }

    /**
     * Define Nodes for start and end of selection
     */
    const boundNodes = [
      /** the Node in which the selection begins */
      selection.anchorNode as HTMLElement,
      /** the Node in which the selection ends */
      selection.focusNode as HTMLElement,
    ];

    /**
     * For each selection parent Nodes we try to find target tag [with target class name]
     * It would be saved in parentTag variable
     */
    boundNodes.forEach((parent) => {
      /** Reset tags limit */
      let searchDepthIterable = searchDepth;

      while (searchDepthIterable > 0 && parent.parentNode) {
        /**
         * Check tag's name
         */
        if (parent.tagName === tagName) {
          /**
           * Save the result
           */
          parentTag = parent;

          /**
           * Optional additional check for class-name mismatching
           */
          if (className && parent.classList && !parent.classList.contains(className)) {
            parentTag = null;
          }

          /**
           * If we have found required tag with class then go out from the cycle
           */
          if (parentTag) {
            break;
          }
        }

        /**
         * Target tag was not found. Go up to the parent and check it
         */
        parent = parent.parentNode as HTMLElement;
        searchDepthIterable--;
      }
    });

    /**
     * Return found tag or null
     */
    return parentTag;
  }

  /**
   * Expands selection range to the passed parent node
   *
   * @param {HTMLElement} element
   */
  public expandToTag(element: HTMLElement): void {
    const selection = window.getSelection();

    selection.removeAllRanges();
    const range = document.createRange();

    range.selectNodeContents(element);
    selection.addRange(range);
  }
}
