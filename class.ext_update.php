<?php
namespace Mediadreams\MdNewsAuthor;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Christoph Daecke <typo3@mediadreams.org>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


/**
 * This class updates md_news_author from version 2.x to 3.x.
 *
 * @author      Christoph Daecke <typo3@mediadreams.org>
 * @package     TYPO3
 * @subpackage  md_news_author
 */
class ext_update {

  /** @var \TYPO3\CMS\Core\Database\DatabaseConnection */
  protected $dbCon;

  /**
   * Creates the instance of the class.
   */
  public function __construct()
  {
    $this->dbCon = $GLOBALS['TYPO3_DB'];
  }

  /**
   * Runs the update.
   */
  public function main()
  {
    if ($this->updateNeeded()) {

      // get all news records with a news author attached
      $allNewsRecords = $this->dbCon->exec_SELECTgetRows (
        'uid, news_author', 
        'tx_news_domain_model_news', 
        'news_author > 0'
      );

      foreach ($allNewsRecords as $news) {
        $fields_values = [
          'uid_local' => $news['uid'],
          'uid_foreign' => $news['news_author'],
          'sorting' => 1,
          'sorting_foreign' => 0
        ];

        // insert data into mm-table
        $this->dbCon->exec_INSERTquery (
          'tx_mdnewsauthor_news_newsauthor_mm', 
          $fields_values
        );

        // update news table
        $this->dbCon->exec_UPDATEquery (
          'tx_news_domain_model_news', 
          'uid = '. $news['uid'],
          ['news_author' => 1]
        );
      }

      $this->dbCon->sql_free_result ($allNewsRecords);

      
      // Update authors table.
      // Get number of news per author
      $newsPerAuthor = $this->dbCon->exec_SELECTgetRows (
        'count(uid_local) AS numberOfNews, uid_foreign', 
        'tx_mdnewsauthor_news_newsauthor_mm', 
        '1 = 1',
        'uid_foreign'
      );

      foreach ($newsPerAuthor as $author) {
        // update author table, set number of news
        $this->dbCon->exec_UPDATEquery (
          'tx_mdnewsauthor_domain_model_newsauthor', 
          'uid = '. $author['uid_foreign'],
          ['news' => $author['numberOfNews']]
        );
      }

      $this->dbCon->sql_free_result ($newsPerAuthor);
      
      return "Update successfully done!<br><br><strong>Don't forget to clear the cache!</strong>";
    }

    return "No update needed.";
  }

  /**
   * Checks if the script should execute.
   *
   * @return bool
   */
  public function access()
  {
    return $this->updateNeeded();
  }

  /**
   * Checks if migration needs to be done.
   *
   * @return bool
   */
  protected function updateNeeded()
  {

    // check, if mm-table exists
    $mmTable = $this->dbCon->sql_query("SHOW TABLES LIKE 'tx_mdnewsauthor_news_newsauthor_mm'");

    if ($mmTable->num_rows == 1) {
      $count = $this->dbCon->exec_SELECTcountRows (
        '*', 
        'tx_mdnewsauthor_news_newsauthor_mm'
      );

      if ($count == 0) {
        // if table is empty, we assume that the migration needs to run!
        return true;
      }

    }

    return false;
  }

}
