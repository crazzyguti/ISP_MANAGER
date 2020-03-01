/**
 * @class MoveUpTune
 * @classdesc Editor's default tune that moves up selected block
 *
 * @copyright <CodeX Team> 2018
 */
import $ from '../dom';
import {API, BlockTune} from '../../../types';

export default class MoveUpTune implements BlockTune {

  /**
   * Property that contains Editor.js API methods
   * @see {api.md}
   */
  private readonly api: API;

  /**
   * Styles
   * @type {{wrapper: string}}
   */
  private CSS = {
    button: 'ce-settings__button',
    wrapper: 'ce-tune-move-up',
    animation: 'wobble',
  };

  /**
   * MoveUpTune constructor
   *
   * @param {{api: API}} api
   */
  public constructor({api}) {
    this.api = api;
  }

  /**
   * Create "MoveUp" button and add click event listener
   * @returns [HTMLElement}
   */
  public render(): HTMLElement {
    const moveUpButton = $.make('div', [this.CSS.button, this.CSS.wrapper], {});
    moveUpButton.appendChild($.svg('arrow-up', 14, 14));
    this.api.listeners.on(
      moveUpButton,
      'click',
      (event) => this.handleClick(event as MouseEvent, moveUpButton),
      false,
      );
    return moveUpButton;
  }

  /**
   * Move current block up
   * @param {MouseEvent} event
   * @param {HTMLElement} button
   */
  public handleClick(event: MouseEvent, button: HTMLElement): void {

    const currentBlockIndex = this.api.blocks.getCurrentBlockIndex();

    if (currentBlockIndex === 0) {
      button.classList.add(this.CSS.animation);

      window.setTimeout( () => {
        button.classList.remove(this.CSS.animation);
      }, 500);
      return;
    }

    const currentBlockElement = this.api.blocks.getBlockByIndex(currentBlockIndex);
    const previousBlockElement = this.api.blocks.getBlockByIndex(currentBlockIndex - 1);

    /**
     * Here is two cases:
     *  - when previous block has negative offset and part of it is visible on window, then we scroll
     *  by window's height and add offset which is mathematically difference between two blocks
     *
     *  - when previous block is visible and has offset from the window,
     *      than we scroll window to the difference between this offsets.
     */
    const currentBlockCoords = currentBlockElement.getBoundingClientRect(),
      previousBlockCoords = previousBlockElement.getBoundingClientRect();

    let scrollUpOffset;

    if (previousBlockCoords.top > 0) {
      scrollUpOffset = Math.abs(currentBlockCoords.top) - Math.abs(previousBlockCoords.top);
    } else {
      scrollUpOffset = window.innerHeight - Math.abs(currentBlockCoords.top) + Math.abs(previousBlockCoords.top);
    }

    window.scrollBy(0, -1 * scrollUpOffset);

    /** Change blocks positions */
    this.api.blocks.swap(currentBlockIndex, currentBlockIndex - 1);
  }
}
