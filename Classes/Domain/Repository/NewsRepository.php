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

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * The repository for News
 */
class NewsRepository extends \GeorgRinger\News\Domain\Repository\NewsRepository
{
  /**
   * News author MM table
   *
   * @var string
   */
  const TABLE_AUTHOR_MM = 'tx_mdnewsauthor_news_newsauthor_mm';


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
   * We use this to get the news records ordered by "datetime"
   *
   * @param int $authorUid Uid of author
   * @return obj | false
   */
  public function getNewsByAuthor(int $authorUid)
  {
    // Initialize Query Builder for table 'tx_mdnewsauthor_news_newsauthor_mm'
    /** @var QueryBuilder $queryBuilderNews */
    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
                          ->getQueryBuilderForTable(self::TABLE_AUTHOR_MM);

    // find all news IDs which belong to the author
    $newsUids = $queryBuilder
      ->select('uid_local')
      ->from(self::TABLE_AUTHOR_MM)
      ->where(
          $queryBuilder->expr()->eq(
            'uid_foreign',
            $queryBuilder->createNamedParameter((int)$authorUid, \PDO::PARAM_INT)
          )
        )
      ->execute()
      ->fetchAll();

    // build array with news IDs
    $newsArr = [];
    foreach ($newsUids as $newsUid) {
      $newsArr[] = $newsUid['uid_local'];
    }
    
    // finally get the news records
    if ( count($newsArr) > 0 ) {
      $constraint = [];
      $query = $this->createQuery();

      $constraints[] = $query->in('uid', $newsArr);

      $query->matching(
        $query->logicalAnd($constraints)
      );

      return $query->execute();
    } else {
      return false;
    }

  }

}
