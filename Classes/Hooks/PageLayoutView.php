<?php
namespace Mediadreams\MdNewsAuthor\Hooks;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Christoph Daecke <typo3@mediadreams.org>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * PageLayoutView
 */
class PageLayoutView implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface {

  /**
   * Preprocesses the preview rendering of a content element.
   *
   * @param PageLayoutView $parentObject Calling parent object
   * @param boolean $drawItem Whether to draw the item using the default functionalities
   * @param string $headerContent Header content
   * @param string $itemContent Item content
   * @param array $row Record row of tt_content
   * @return void
   */
  public function preProcess(\TYPO3\CMS\Backend\View\PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {

    if ($row['list_type'] !== 'mdnewsauthor_newsauthor') {
      return;
    }

    $drawItem = FALSE;
    $headerContent = $header = $parentObject->linkEditContent('<strong>' . htmlspecialchars($GLOBALS['LANG']->sL('LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor')) . '</strong>', $row);

    $flexform = GeneralUtility::xml2array($row['pi_flexform']);

    if( isset($flexform['data']['general']['lDEF']['switchableControllerActions']['vDEF']) ) {
      $switchableControllerActions = html_entity_decode( strip_tags( $flexform['data']['general']['lDEF']['switchableControllerActions']['vDEF'] ) );

      $actionKey = mb_substr($switchableControllerActions, strpos($switchableControllerActions, '->')+2);
      $actionTranslation = $GLOBALS['LANG']->sL('LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:flex_author.'.$actionKey);

      $headerContent .= $parentObject->linkEditContent('<br><strong style="text-transform: uppercase">' . htmlspecialchars($actionTranslation) . '</strong>', $row);
    }
        
  }

}
