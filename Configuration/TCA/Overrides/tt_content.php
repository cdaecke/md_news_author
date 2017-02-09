<?php
if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

// remove field "Plugin Mode" for pluign "mdnewsauthor_newsauthor" since we don't neet it!
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['mdnewsauthor_newsauthor'] = 'select_key';
