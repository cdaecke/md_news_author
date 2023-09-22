<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "md_news_author"
 *
 * Auto generated by Extension Builder 2016-09-15
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'News Author',
    'description' => 'Adds one or more authors to a tx_news record, show a list of all authors and display a detail page of the author containing the attached news entries.',
    'category' => 'plugin',
    'author' => 'Christoph Daecke',
    'author_email' => 'typo3@mediadreams.org',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '7.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-12.4.99',
            'news' => '9.0-11.99',
            'numbered_pagination' => '1.0.1-1.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
