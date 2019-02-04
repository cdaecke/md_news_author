<?php
if (!defined('TYPO3_MODE')) {
  die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'md_news_author';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
  'Mediadreams.' . $_EXTKEY,
  'NewsAuthor',
  array(
    'NewsAuthor' => '',
    
  ),
  // non-cacheable actions
  array(
    'NewsAuthor' => '',
    
  )
);

/**
 * Add page TsConfig
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
  '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/Page/TCEFORM.ts">'
);

$GLOBALS['TYPO3_CONF_VARS']
        ['SC_OPTIONS']
        ['cms/layout/class.tx_cms_layout.php']
        ['tt_content_drawItem']
        [$_EXTKEY] = 'Mediadreams\\MdNewsAuthor\\Hooks\\PageLayoutView';
