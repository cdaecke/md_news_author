<?php
namespace Mediadreams\MdNewsAuthor\Domain\Repository;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Christoph Daecke <typo3@mediadreams.org>
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
 * The repository for News
 */
class NewsRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

  // Ordering of result
  protected $defaultOrderings = array(
    'datetime' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
  );

  public function createQuery()
  {
    $query = parent::createQuery();
    $settings = $query->getQuerySettings();
    $settings->setRespectStoragePage(false);
    $query->setQuerySettings($settings);
    return $query;
  }

  /**
   * Find news by authors uid
   *
   * @param int $authorUid Uid of author
   * @return array
   */
  public function getNewsByAuthor($authorUid)
  {
    $data = [];

    // look for translated author and overwrite $authorUid
    if ($GLOBALS['TSFE']->sys_language_uid > 0) {
      $select = 'uid';
      $table = 'tx_mdnewsauthor_domain_model_newsauthor';
      $where = '(sys_language_uid = ' .(int)$GLOBALS['TSFE']->sys_language_uid. ' AND l10n_parent = ' .(int)$authorUid. ' )';  
      $where  .= $GLOBALS['TSFE']->sys_page->enableFields($table);    
      $order = '';
      $group = '';
      $limit = '1';
      $translatedAuthor = $this->getDatabaseConnection()->exec_SELECTgetRows($select, $table, $where, $group, $order, $limit);

      if ($translatedAuthor && $translatedAuthor[0]['uid']) {
        $authorUid = $translatedAuthor[0]['uid'];
      }
    }

    $res = $this->getDatabaseConnection()->exec_SELECT_mm_query(
      'tx_news_domain_model_news.*',
      'tx_news_domain_model_news',
      'tx_mdnewsauthor_news_newsauthor_mm',
      'tx_mdnewsauthor_domain_model_newsauthor',
      ' AND (tx_mdnewsauthor_domain_model_newsauthor.uid=' . (int)$authorUid . ') '.$GLOBALS['TSFE']->sys_page->enableFields('tx_news_domain_model_news'),
      '',
      'tx_news_domain_model_news.datetime DESC'
    );

    while ($row = $this->getDatabaseConnection()->sql_fetch_assoc($res)) {
      $data[] = $row;
    }

    $this->getDatabaseConnection()->sql_free_result($res);

    return $data;
  }

  /**
   * @return \TYPO3\Cms\Core\Database\DatabaseConnection
   */
  protected static function getDatabaseConnection()
  {
    return $GLOBALS['TYPO3_DB'];
  }
  
}
