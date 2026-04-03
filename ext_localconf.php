<?php
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Mediadreams\MdNewsAuthor\Controller\NewsAuthorController;

defined('TYPO3') or die();

call_user_func(
    function () {
        /**
         * Array with available plugins and their configuration
         */
        $plugins = [
            'list' => [
                'cacheable' => 'list',
                'nonCacheable' => 'list'
            ],
            'show' => [
                'cacheable' => 'show',
                'nonCacheable' => ''
            ],
        ];

        foreach ($plugins as $plugin => $pluginOptions) {
            ExtensionUtility::configurePlugin(
                'MdNewsAuthor',
                $plugin,
                [
                    NewsAuthorController::class => $pluginOptions['cacheable'],
                ],
                // non-cacheable actions
                [
                    NewsAuthorController::class => $pluginOptions['nonCacheable'],
                ],
                ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
            );
        }

        /**
         * Extend ext:news
         */
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'md_news_author';
    }
);
