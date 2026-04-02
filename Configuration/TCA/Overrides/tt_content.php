<?php
defined('TYPO3') or die();

/**
 * Add new select group for list_type
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
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
    $pluginSignature = \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'md_news_author',
        $plugin,
        'LLL:EXT:md_news_author/Resources/Private/Language/locallang.xlf:plugin.' . $plugin . '.title',
        'mdnewsauthor_' . $plugin,
        'mdNewsAuthor',
        'LLL:EXT:md_news_author/Resources/Private/Language/locallang.xlf:plugin.' . $plugin . '.description',
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,pi_flexform,pages,recursive',
        $pluginSignature,
        'after:subheader'
    );

    // add flexform
    TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        '*',
        'FILE:EXT:md_news_author/Configuration/FlexForms/' . ucfirst($plugin) . '.xml',
        $pluginSignature
    );
}
