<?php
defined('TYPO3_MODE') or die();

/**
 * Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Mediadreams.md_news_author',
    'NewsAuthor',
    'News author',
    'EXT:md_news_author/Resources/Public/Icons/tx_mdnewsauthor_domain_model_newsauthor.svg'
);

/**
 * Add plugin configuration
 */
$pluginSignature = 'mdnewsauthor_newsauthor';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

// add flexform
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:md_news_author/Configuration/FlexForms/newsAuthor.xml'
);
