<?php
if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

$tmp_news_author_columns = array(

  'news_author' => array(
    'exclude' => 1,
    'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor',
    'config' => array(
      'type' => 'select',
      'renderType' => 'selectMultipleSideBySide',
      'enableMultiSelectFilterTextfield' => true,
      'foreign_table' => 'tx_mdnewsauthor_domain_model_newsauthor',
      'foreign_table_where' => ' ###PAGE_TSCONFIG_STR### AND tx_mdnewsauthor_domain_model_newsauthor.deleted = 0 AND tx_mdnewsauthor_domain_model_newsauthor.hidden = 0 ORDER By tx_mdnewsauthor_domain_model_newsauthor.lastname ASC, tx_mdnewsauthor_domain_model_newsauthor.firstname ASC',
      'MM' => 'tx_mdnewsauthor_news_newsauthor_mm',
      'size' => 10,
      'autoSizeMax' => 30,
      'maxitems' => 99,
      'multiple' => 1,
    ),
  ),

);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
  'tx_news_domain_model_news',
  $tmp_news_author_columns
);

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
  'tx_news_domain_model_news',
  '--div--;LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.news_author_tab,news_author'
);
