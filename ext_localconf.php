<?php
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
            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
                'MdNewsAuthor',
                $plugin,
                [
                    \Mediadreams\MdNewsAuthor\Controller\NewsAuthorController::class => $pluginOptions['cacheable'],
                ],
                // non-cacheable actions
                [
                    \Mediadreams\MdNewsAuthor\Controller\NewsAuthorController::class => $pluginOptions['nonCacheable'],
                ]
            );
        }

        /**
         * Extend ext:news
         */
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'md_news_author';
    }
);
