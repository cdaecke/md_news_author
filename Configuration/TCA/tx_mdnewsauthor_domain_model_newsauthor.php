<?php

defined('TYPO3') or die();

return [
    'ctrl' => [
        'title' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor',
        'label' => 'lastname',
        'label_alt' => 'firstname',
        'label_alt_force' => true, // use lastname and firstname as label
        'default_sortby' => 'lastname',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'typeicon_classes' => [
            'default' => 'tx_mdnewsauthor_domain_model_newsauthor',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:palette.general;palette_name,
                --palette--;LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:palette.company;palette_company,
                --palette--;LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:palette.contact;palette_contact,
                --palette--;LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:palette.social;palette_social,
                bio,image,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden,starttime,endtime,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                    categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;paletteLanguage,
            ',
        ],
    ],
    'palettes' => [
        'palette_name' => [
            'showitem' => '
                gender, title,
                --linebreak--,
                firstname, lastname,
                --linebreak--,
                slug,
            ',
        ],
        'palette_company' => [
            'showitem' => '
                company, position,
            ',
        ],
        'palette_contact' => [
            'showitem' => '
                phone,
                --linebreak--,
                email, www,
            ',
        ],
        'palette_social' => [
            'showitem' => '
                facebook, twitter,
                --linebreak--,
                linkedin, xing,
            ',
        ],
        'paletteLanguage' => [
            'showitem' => '
                sys_language_uid, l10n_parent, l10n_diffsource,
            ',
        ],
    ],
    'columns' => [

        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_mdnewsauthor_domain_model_newsauthor',
                'foreign_table_where' => 'AND {#tx_mdnewsauthor_domain_model_newsauthor}.{#pid}=###CURRENT_PID### AND {#tx_mdnewsauthor_domain_model_newsauthor}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],

        'gender' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '-', 'value' => ''],
                    ['label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender.female', 'value' => 'f'],
                    ['label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender.male', 'value' => 'm'],
                    ['label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender.divers', 'value' => 'd'],
                ],
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.title',
            'config' => [
                'type' => 'input',
                'size' => 10,
            ],
        ],
        'firstname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.firstname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'required' => true,
            ],
        ],
        'lastname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.lastname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'required' => true,
            ],
        ],
        'slug' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.slug',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['firstname', 'lastname'],
                    'fieldSeparator' => '-',
                    'replacements' => [
                        '/' => '-',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => '',
            ],
        ],
        'company' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.company',
            'config' => [
                'type' => 'input',
                'size' => 30,
            ],
        ],
        'position' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.position',
            'config' => [
                'type' => 'input',
                'size' => 30,
            ],
        ],
        'phone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.phone',
            'config' => [
                'type' => 'input',
                'size' => 30,
            ],
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.email',
            'config' => [
                'type' => 'email',
                'size' => 30,
            ],
        ],
        'www' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.www',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'softref' => 'url',
            ],
        ],
        'facebook' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.facebook',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'softref' => 'url',
            ],
        ],
        'twitter' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.twitter',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'softref' => 'url',
            ],
        ],
        'xing' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.xing',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'softref' => 'url',
            ],
        ],
        'linkedin' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.linkedin',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'softref' => 'url',
            ],
        ],
        'bio' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.bio',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.image',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types',
            ],
        ],
        'news' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.news',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'categories' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category',
            'config' => [
                'type' => 'category',
            ],
        ],
    ],
];
