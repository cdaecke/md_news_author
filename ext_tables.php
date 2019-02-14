<?php
defined('TYPO3_MODE') or die();

/**
 * add Context Sensitive Help (CSH)
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mdnewsauthor_domain_model_newsauthor', 'EXT:md_news_author/Resources/Private/Language/locallang_csh_tx_mdnewsauthor_domain_model_newsauthor.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_news_domain_model_news', 'EXT:md_news_author/Resources/Private/Language/locallang_csh_tx_news_domain_model_news.xlf');

/**
 * Allow author records on standard pages
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mdnewsauthor_domain_model_newsauthor');
