<?php
if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

return array(
  'ctrl' => array(
    'title' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor',
    'label' => 'lastname',
    'label_alt' => 'firstname',
    'label_alt_force' => 1, // use lastname and firstname as label
    'tstamp' => 'tstamp',
    'crdate' => 'crdate',
    'cruser_id' => 'cruser_id',
    'dividers2tabs' => TRUE,
    'versioningWS' => 2,
    'versioning_followPages' => TRUE,

    'languageField' => 'sys_language_uid',
    'transOrigPointerField' => 'l10n_parent',
    'transOrigDiffSourceField' => 'l10n_diffsource',
    'delete' => 'deleted',
    'enablecolumns' => array(
      'disabled' => 'hidden',
      'starttime' => 'starttime',
      'endtime' => 'endtime',
    ),
    'searchFields' => 'title,firstname,lastname,bio,image,',
    'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('md_news_author') . 'Resources/Public/Icons/tx_mdnewsauthor_domain_model_newsauthor.gif'
  ),
  'interface' => array(
    'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, gender, title, firstname, lastname, companie, position, phone, email, www, facebook, twitter, xing, linkedin, bio, image',
  ),
  'types' => array(
    '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, ;;palette_name, ;;palette_contact, bio;;;richtext:rte_transform[mode=ts_links], image, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, hidden, starttime, endtime'),
  ),
  'palettes' => array(
    'palette_name' => array('showitem' => 'gender, title, --linebreak--, firstname, lastname'),
    'palette_companie' => array('showitem' => 'companie, position'),
    'palette_contact' => array('showitem' => 'phone, --linebreak--, email, www, --linebreak--, facebook, twitter, --linebreak--, linkedin, xing'),
  ),
  'columns' => array(
  
    'sys_language_uid' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
      'config' => array(
        'type' => 'select',
        'renderType' => 'selectSingle',
        'special' => 'languages',
        'foreign_table' => 'sys_language',
        'foreign_table_where' => 'ORDER BY sys_language.title',
        'items' => array(
          array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1, 'flags-multiple')
        ),
        'default' => 0,
      ),
    ),
    'l10n_parent' => array(
      'displayCond' => 'FIELD:sys_language_uid:>:0',
      'exclude' => 1,
      'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
      'config' => array(
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => array(
          array('', 0),
        ),
        'foreign_table' => 'tx_mdnewsauthor_domain_model_newsauthor',
        'foreign_table_where' => 'AND tx_mdnewsauthor_domain_model_newsauthor.pid=###CURRENT_PID### AND tx_mdnewsauthor_domain_model_newsauthor.sys_language_uid IN (-1,0)',
      ),
    ),
    'l10n_diffsource' => array(
      'config' => array(
        'type' => 'passthrough',
      ),
    ),

    't3ver_label' => array(
      'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'max' => 255,
      )
    ),
  
    'hidden' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
      'config' => array(
        'type' => 'check',
      ),
    ),
    'starttime' => array(
      'exclude' => 1,
      'l10n_mode' => 'mergeIfNotBlank',
      'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
      'config' => array(
        'type' => 'input',
        'size' => 13,
        'max' => 20,
        'eval' => 'datetime',
        'checkbox' => 0,
        'default' => 0,
        'range' => array(
          'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
        ),
      ),
    ),
    'endtime' => array(
      'exclude' => 1,
      'l10n_mode' => 'mergeIfNotBlank',
      'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
      'config' => array(
        'type' => 'input',
        'size' => 13,
        'max' => 20,
        'eval' => 'datetime',
        'checkbox' => 0,
        'default' => 0,
        'range' => array(
          'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
        ),
      ),
    ),

    'gender' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender',
      'config' => array(
        'type' => 'select',
        'size' => 1,
        'items' => array(
          array('-', ''),
          array('LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender.female', 'f'),
          array('LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.gender.male', 'm'),
        )
      ),
    ),
    'title' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.title',
      'config' => array(
        'type' => 'input',
        'size' => 10,
        'eval' => 'trim'
      ),
    ),
    'firstname' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.firstname',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim,required'
      ),
    ),
    'lastname' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.lastname',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim,required'
      ),
    ),
    'companie' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.companie',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim,required'
      ),
    ),
    'position' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.position',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim,required'
      ),
    ),
    'phone' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.phone',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim'
      ),
    ),
    'email' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.email',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim,email'
      ),
    ),
    'www' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.www',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim'
      ),
    ),
    'facebook' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.facebook',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim'
      ),
    ),
    'twitter' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.twitter',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim'
      ),
    ),
    'xing' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.xing',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim'
      ),
    ),
    'linkedin' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.linkedin',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim'
      ),
    ),
    'bio' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.bio',
      'config' => array(
        'type' => 'text',
        'cols' => 40,
        'rows' => 15,
        'eval' => 'trim',
        'wizards' => array(
          'RTE' => array(
            'icon' => 'wizard_rte2.gif',
            'notNewRecords'=> 1,
            'RTEonly' => 1,
            'module' => array(
              'name' => 'wizard_rich_text_editor',
              'urlParameters' => array(
                'mode' => 'wizard',
                'act' => 'wizard_rte.php'
              )
            ),
            'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
            'type' => 'script'
          )
        )
      ),
    ),
    'image' => array(
      'exclude' => 1,
      'l10n_mode' => 'mergeIfNotBlank',
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.image',
      'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'fal_media',
        array(
          'appearance' => array(
            'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
            'showPossibleLocalizationRecords' => 1,
            'showRemovedLocalizationRecords' => 1,
            'showAllLocalizationLink' => 1,
            'showSynchronizationLink' => 1
          ),
          'minitems' => 0,
          'maxitems' => 1,
          // custom configuration for displaying fields in the overlay/reference table
          // to use the imageoverlayPalette instead of the basicoverlayPalette
          'foreign_match_fields' => array(
            'fieldname' => 'image',
            'tablenames' => 'tx_mdnewsauthor_domain_model_newsauthor',
            'table_local' => 'sys_file',
          ),
          'foreign_types' => array(
            '0' => array(
              'showitem' => '
              --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
              --palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
              'showitem' => '
              --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
              --palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
              'showitem' => '
              --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
              --palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
              'showitem' => '
              --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
              --palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
              'showitem' => '
              --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
              --palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
              'showitem' => '
              --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
              --palette--;;filePalette'
            )
          ),
        ),
        //$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
        'gif,jpg,jpeg,png'
      ),
    ),
    'news' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:md_news_author/Resources/Private/Language/locallang_db.xlf:tx_mdnewsauthor_domain_model_newsauthor.news',
      'config' => array(
        'type' => 'select',
        'multiple' => 1,
        'foreign_table' => 'tx_news_domain_model_news',
        'MM' => 'tx_mdnewsauthor_news_newsauthor_mm',
        'MM_opposite_field' => 'news',
        'foreign_table_where' => ' AND tx_news_domain_model_news.pid=###CURRENT_PID### ORDER BY tx_news_domain_model_news.datetime DESC ',
        'minitems' => 0,
        'maxitems' => 99,
      ),
    ),
    
  ),
);
