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

$GLOBALS['TYPO3_CONF_VARS']
        ['SC_OPTIONS']
        ['cms/layout/class.tx_cms_layout.php']
        ['tt_content_drawItem']
        [$_EXTKEY] = 'Mediadreams\\MdNewsAuthor\\Hooks\\PageLayoutView';
