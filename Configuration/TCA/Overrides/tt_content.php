<?php
defined('TYPO3') or die();

/**
 * Add new select group for list_type
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'list_type',
    'mdNewsAuthor',
    'LLL:EXT:md_news_author/Resources/Private/Language/locallang.xlf:tx_newsauthor_domain_model_newsauthor',
    'after:default'
);

/**
 * Array with available plugins
 */
$plugins = [
    'list',
    'show',
];

/**
 * Register Plugins
 */
foreach ($plugins as $plugin) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'md_news_author',
        ucfirst($plugin),
        'LLL:EXT:md_news_author/Resources/Private/Language/locallang.xlf:plugin.' . $plugin . '.title',
        'mdnewsauthor_' . $plugin,
        'mdNewsAuthor'
    );

    // add flexform
    $pluginSignature = 'mdnewsauthor_' . $plugin;
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

    TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        'FILE:EXT:md_news_author/Configuration/FlexForms/' . ucfirst($plugin) . '.xml'
    );

    //$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
}
