import Module from '../__module';
import Block from '../block';
import SelectionUtils from '../selection';
import _ from '../utils';

export default class CrossBlockSelection extends Module {
  /**
   * Block where selection is started
   */
  private firstSelectedBlock: Block;

  /**
   * Last selected Block
   */
  private lastSelectedBlock: Block;

  /**
   * Sets up listeners
   *
   * @param {MouseEvent} event - mouse down event
   */
  public watchSelection(event: MouseEvent): void {
    if (event.button !== _.mouseButtons.LEFT) {
      return;
    }

    const {BlockManager, UI, Listeners} = this.Editor;

    this.firstSelectedBlock = BlockManager.getBlock(event.target as HTMLElement);
    this.lastSelectedBlock = this.firstSelectedBlock;

    Listeners.on(document, 'mouseover', this.onMouseOver);
    Listeners.on(document, 'mouseup', this.onMouseUp);
  }

  /**
   * Change selection state of the next Block
   * Used for CBS via Shift + arrow keys
   *
   * @param {boolean} next - if true, toggle next block. Previous otherwise
   */
  public toggleBlockSelectedState(next: boolean = true): void {
    const {BlockManager} = this.Editor;

    if (!this.lastSelectedBlock) {
      this.lastSelectedBlock = this.firstSelectedBlock = BlockManager.currentBlock;
    }

    if (this.firstSelectedBlock === this.lastSelectedBlock) {
      this.firstSelectedBlock.selected = true;
      SelectionUtils.get().removeAllRanges();
    }

    const nextBlockIndex = BlockManager.blocks.indexOf(this.lastSelectedBlock) + (next ? 1 : -1);
    const nextBlock = BlockManager.blocks[nextBlockIndex];

    if (!nextBlock) {
      return;
    }

    if (this.lastSelectedBlock.selected !== nextBlock.selected) {
      nextBlock.selected = true;
    } else {
      this.lastSelectedBlock.selected = false;
    }

    this.lastSelectedBlock = nextBlock;
  }

  /**
   * Clear saved state
   *
   * @param {Event} reason - event caused clear of selection
   */
  public clear(reason?: Event) {
    const {BlockManager, BlockSelection, Caret} = this.Editor;
    const fIndex = BlockManager.blocks.indexOf(this.firstSelectedBlock);
    const lIndex = BlockManager.blocks.indexOf(this.lastSelectedBlock);

    if (BlockSelection.anyBlockSelected && fIndex > -1 && lIndex > -1) {
      if (reason && reason instanceof KeyboardEvent) {
        /**
         * Set caret depending on pressed key if pressed key is an arrow.
         */
        switch (reason.keyCode) {
          case _.keyCodes.DOWN:
          case _.keyCodes.RIGHT:
            Caret.setToBlock(BlockManager.blocks[Math.max(fIndex, lIndex)], Caret.positions.END);
            break;

          case _.keyCodes.UP:
          case _.keyCodes.LEFT:
            Caret.setToBlock(BlockManager.blocks[Math.min(fIndex, lIndex)], Caret.positions.START);
            break;
          default:
            Caret.setToBlock(BlockManager.blocks[Math.max(fIndex, lIndex)], Caret.positions.END);
        }
      } else {
        /**
         * By default set caret at the end of the last selected block
         */
        Caret.setToBlock(BlockManager.blocks[Math.max(fIndex, lIndex)], Caret.positions.END);
      }
    }

    this.firstSelectedBlock = this.lastSelectedBlock = null;
  }

  /**
   * Mouse up event handler.
   * Removes the listeners
   */
  private onMouseUp  = (): void => {
    const {Listeners} = this.Editor;

    Listeners.off(document, 'mouseover', this.onMouseOver);
    Listeners.off(document, 'mouseup', this.onMouseUp);
  }

  /**
   * Mouse over event handler
   * Gets target and related blocks and change selected state for blocks in between
   *
   * @param {MouseEvent} event
   */
  private onMouseOver = (event: MouseEvent): void => {
    const {BlockManager} = this.Editor;

    const relatedBlock = BlockManager.getBlockByChildNode(event.relatedTarget as Node) || this.lastSelectedBlock;
    const targetBlock = BlockManager.getBlockByChildNode(event.target as Node);

    if (!relatedBlock || !targetBlock) {
      return;
    }

    if (targetBlock === relatedBlock) {
      return;
    }

    if (relatedBlock === this.firstSelectedBlock) {
      SelectionUtils.get().removeAllRanges();

      relatedBlock.selected = true;
      targetBlock.selected = true;
      return;
    }

    if (targetBlock === this.firstSelectedBlock) {
      relatedBlock.selected = false;
      targetBlock.selected = false;
      return;
    }

    this.toggleBlocksSelectedState(relatedBlock, targetBlock);
    this.lastSelectedBlock = targetBlock;
  }

  /**
   * Change blocks selection state between passed two blocks.
   *
   * @param {Block} firstBlock
   * @param {Block} lastBlock
   */
  private toggleBlocksSelectedState(firstBlock: Block, lastBlock: Block): void {
    const {BlockManager} = this.Editor;
    const fIndex = BlockManager.blocks.indexOf(firstBlock);
    const lIndex = BlockManager.blocks.indexOf(lastBlock);

    /**
     * If first and last block have the different selection state
     * it means we should't toggle selection of the first selected block.
     * In the other case we shouldn't toggle the last selected block.
     */
    const shouldntSelectFirstBlock = firstBlock.selected !== lastBlock.selected;

    for (let i = Math.min(fIndex, lIndex); i <= Math.max(fIndex, lIndex); i++) {
      const block = BlockManager.blocks[i];

      if (
        block !== this.firstSelectedBlock &&
        block !== (shouldntSelectFirstBlock ? firstBlock : lastBlock)
      ) {
        BlockManager.blocks[i].selected = !BlockManager.blocks[i].selected;
      }
    }
  }
}
