<?php
if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

// Add categories selection field
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
   'md_news_author',
   'tx_mdnewsauthor_domain_model_newsauthor',
   'categories',
   array(
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.categories',
      'exclude' => 1,
      'l10n_mode' => 'mergeIfNotBlank',
      'l10n_display' => 'hideDiff',
   )
);
