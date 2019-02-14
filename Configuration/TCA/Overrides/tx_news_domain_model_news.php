<?php
defined('TYPO3_MODE') or die();


$tmp_news_author_columns = [

    'news_author' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'enableMultiSelectFilterTextfield' => true,
            'foreign_table' => 'tx_mdnewsauthor_domain_model_newsauthor',
            'foreign_table_where' => ' AND ( ###PAGE_TSCONFIG_STR### = \'FALSE\' OR tx_mdnewsauthor_domain_model_newsauthor.pid = ###PAGE_TSCONFIG_STR### ) AND tx_mdnewsauthor_domain_model_newsauthor.deleted = 0 AND tx_mdnewsauthor_domain_model_newsauthor.hidden = 0 AND tx_mdnewsauthor_domain_model_newsauthor.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_mdnewsauthor_domain_model_newsauthor.lastname ASC, tx_mdnewsauthor_domain_model_newsauthor.firstname ASC',
            'MM' => 'tx_mdnewsauthor_news_newsauthor_mm',
            'size' => 10,
            'autoSizeMax' => 30,
            'maxitems' => 99,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_news_domain_model_news',
    $tmp_news_author_columns
);

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    '--div--;LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.news_author_tab,news_author'
);
