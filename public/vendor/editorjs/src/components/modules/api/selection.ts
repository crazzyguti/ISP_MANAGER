import Module from '../../__module';
import SelectionUtils from '../../selection';
import {Selection as SelectionAPIInterface} from '../../../../types/api';

/**
 * @class SelectionAPI
 * Provides with methods working with SelectionUtils
 */
export default class SelectionAPI extends Module {
  /**
   * Available methods
   * @return {SelectionAPIInterface}
   */
  get methods(): SelectionAPIInterface {
    return {
      findParentTag: (tagName: string, className?: string) => this.findParentTag(tagName, className),
      expandToTag: (node: HTMLElement) => this.expandToTag(node),
    };
  }

  /**
   * Looks ahead from selection and find passed tag with class name
   * @param {string} tagName - tag to find
   * @param {string} className - tag's class name
   * @return {HTMLElement|null}
   */
  public findParentTag(tagName: string, className?: string): HTMLElement|null {
    return new SelectionUtils().findParentTag(tagName, className);
  }

  /**
   * Expand selection to passed tag
   * @param {HTMLElement} node - tag that should contain selection
   */
  public expandToTag(node: HTMLElement): void {
    new SelectionUtils().expandToTag(node);
  }

}
