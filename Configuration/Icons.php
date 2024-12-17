<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'tx_mdnewsauthor_domain_model_newsauthor' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:md_news_author/Resources/Public/Icons/tx_mdnewsauthor_domain_model_newsauthor.svg',
    ],
    'mdnewsauthor_list' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:md_news_author/Resources/Public/Icons/tx_mdnewsauthor_domain_model_list.svg',
    ],
    'mdnewsauthor_show' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:md_news_author/Resources/Public/Icons/tx_mdnewsauthor_domain_model_show.svg',
    ],
];
