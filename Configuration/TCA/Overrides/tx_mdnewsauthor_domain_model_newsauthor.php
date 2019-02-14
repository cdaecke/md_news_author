<?php
defined('TYPO3_MODE') or die();


// if TYPO3 version is 9.2 and newer, add slug functionality
if (version_compare(TYPO3_branch, '9.2', '>=')) {
    $GLOBALS['TCA']['tx_mdnewsauthor_domain_model_newsauthor']['columns']['slug']['config'] = [
        'type' => 'slug',
        'size' => 50,
        'generatorOptions' => [
            'fields' => ['firstname', 'lastname'],
            'fieldSeparator' => '-',
        ],
        'fallbackCharacter' => '-',
        'eval' => 'uniqueInSite',
        'default' => ''
    ];

    // add slug to palette
    $GLOBALS['TCA']['tx_mdnewsauthor_domain_model_newsauthor']['palettes']['palette_name']['showitem'] = $GLOBALS['TCA']['tx_mdnewsauthor_domain_model_newsauthor']['palettes']['palette_name']['showitem'] . ', --linebreak--, slug';
}