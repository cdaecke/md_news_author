<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

/**
 * Add static template
 */
ExtensionManagementUtility::addStaticFile(
    'md_news_author',
    'Configuration/TypoScript',
    'News Author'
);
