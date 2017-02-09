<?php
if (!defined('TYPO3_MODE')) {
  die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
  'Mediadreams.' . $_EXTKEY,
  'NewsAuthor',
  'News author'
);

// add static template
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'News Author');

// add Context Sensitive Help (CSH) 
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mdnewsauthor_domain_model_newsauthor', 'EXT:md_news_author/Resources/Private/Language/locallang_csh_tx_mdnewsauthor_domain_model_newsauthor.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_news_domain_model_news', 'EXT:md_news_author/Resources/Private/Language/locallang_csh_tx_news_domain_model_news.xlf');

// allow author records on standard pages
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mdnewsauthor_domain_model_newsauthor');

// add plugin configuration
$pluginSignature = strtolower(str_replace('_', '', $_EXTKEY) . '_NewsAuthor');
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

// add flexform
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
  $pluginSignature,
  'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/newsAuthor.xml'
);
