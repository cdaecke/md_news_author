<?php

declare(strict_types=1);

use Mediadreams\MdNewsAuthor\Domain\Model\News;

return [
    News::class => [
        'tableName' => 'tx_news_domain_model_news',
        'recordType' => 0,
    ],
];
