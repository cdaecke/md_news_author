<?php
defined('TYPO3_MODE') or die();

return [
    'ctrl' => [
        'title' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor',
        'label' => 'lastname',
        'label_alt' => 'firstname',
        'label_alt_force' => 1, // use lastname and firstname as label
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => TRUE,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,firstname,lastname,bio,image,',
        'iconfile' => 'EXT:md_news_author/Resources/Public/Icons/tx_mdnewsauthor_domain_model_newsauthor.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, gender, title, firstname, lastname, slug, company, position, phone, email, www, facebook, twitter, xing, linkedin, bio, image',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid,l10n_parent,l10n_diffsource,,--palette--;;palette_name,,--palette--;;palette_company,,--palette--;;palette_contact,bio,image,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,hidden,starttime,endtime,--div--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category,categories'],
    ],
    'palettes' => [
        'palette_name' => ['showitem' => 'gender, title, --linebreak--, firstname, lastname, --linebreak--, slug'],
        'palette_company' => ['showitem' => 'company, position'],
        'palette_contact' => ['showitem' => 'phone, --linebreak--, email, www, --linebreak--, facebook, twitter, --linebreak--, linkedin, xing'],
    ],
    'columns' => [

        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1, 'flags-multiple']
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_mdnewsauthor_domain_model_newsauthor',
                'foreign_table_where' => 'AND tx_mdnewsauthor_domain_model_newsauthor.pid=###CURRENT_PID### AND tx_mdnewsauthor_domain_model_newsauthor.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],

        'gender' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'size' => 1,
                'items' => [
                    ['-', ''],
                    ['LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender.female', 'f'],
                    ['LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender.male', 'm'],
                ]
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.title',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim'
            ],
        ],
        'firstname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.firstname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'lastname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.lastname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
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
                        '/' => '-'
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => ''
            ],
        ],
        'company' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.company',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'position' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.position',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'phone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.phone',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,email'
            ],
        ],
        'www' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.www',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'facebook' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.facebook',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'twitter' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.twitter',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'xing' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.xing',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'linkedin' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.linkedin',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bio' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.bio',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
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
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'overrideChildTca' => [
                        'types' => [
                            '0' => [
                                'showitem' => '
                                    --palette--;LLL::EXT:lang/Resources/Private/Language/locallang_general.xlf::sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                    --palette--;LLL::EXT:lang/Resources/Private/Language/locallang_general.xlf::sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    --palette--;LLL::EXT:lang/Resources/Private/Language/locallang_general.xlf::sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                'showitem' => '
                                    --palette--;LLL::EXT:lang/Resources/Private/Language/locallang_general.xlf::sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    --palette--;LLL::EXT:lang/Resources/Private/Language/locallang_general.xlf::sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                    --palette--;LLL::EXT:lang/Resources/Private/Language/locallang_general.xlf::sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ]
                        ],
                    ],
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'maxitems' => 1
                ],
                //$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
                'gif,jpg,jpeg,png'
            ),
        ],
        'news' => [
            'exclude' => true,
            'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.news',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_news_domain_model_news',
                'MM' => 'tx_mdnewsauthor_news_newsauthor_mm',
                'MM_opposite_field' => 'news',
                'foreign_table_where' => ' AND tx_news_domain_model_news.pid=###CURRENT_PID### AND tx_news_domain_model_news.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_news_domain_model_news.datetime DESC ',
                'minitems' => 0,
                'maxitems' => 99,
                'behaviour' => [
                    'allowLanguageSynchronization' => TRUE
                ],
            ],
        ],
      
    ],
];
