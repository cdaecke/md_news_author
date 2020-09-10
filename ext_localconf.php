<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Mediadreams.MdNewsAuthor',
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
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:md_news_author/Configuration/TsConfig/Page/TCEFORM.tsconfig">'
);

$GLOBALS['TYPO3_CONF_VARS']
        ['SC_OPTIONS']
        ['cms/layout/class.tx_cms_layout.php']
        ['tt_content_drawItem']
        ['md_news_author'] = \Mediadreams\MdNewsAuthor\Hooks\PageLayoutView::class;

/**
 * Extend ext:news
 */
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'md_news_author';
