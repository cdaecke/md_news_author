<?php
defined('TYPO3') or die();

/**
 * Add static template
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'md_news_author', 
    'Configuration/TypoScript', 
    'News Author'
);
