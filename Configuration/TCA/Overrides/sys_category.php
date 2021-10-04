<?php
defined('TYPO3_MODE') or die();

// Add categories selection field
// Deprecation: #85613 - Category Registry (https://docs.typo3.org/c/typo3/cms-core/master/en-us/Changelog/11.4/Deprecation-85613-CategoryRegistry.html)
// TODO: As soon, as TYPO3 10 is not supported anymore, remove!
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'md_news_author',
    'tx_mdnewsauthor_domain_model_newsauthor',
    'categories',
    [
        'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.categories',
        'exclude' => 1,
        'l10n_display' => 'hideDiff',
        'behaviour' => [
            'allowLanguageSynchronization' => TRUE
        ],
    ]
);
