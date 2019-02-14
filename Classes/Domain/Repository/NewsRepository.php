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
class NewsRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
  /**
   * News table
   *
   * @var string
   */
  const TABLE_NEWS = 'tx_news_domain_model_news';

  /**
   * News author table
   *
   * @var string
   */
  const TABLE_AUTHOR = 'tx_mdnewsauthor_domain_model_newsauthor';


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
    // Initialize Query Builder for table 'tx_mdnewsauthor_domain_model_newsauthor'
    /** @var QueryBuilder $queryBuilderNews */
    $queryBuilderAuthor = GeneralUtility::makeInstance(ConnectionPool::class)
                          ->getQueryBuilderForTable(self::TABLE_AUTHOR);


    // look for translated author and overwrite $authorUid
    if ($GLOBALS['TSFE']->sys_language_uid > 0) {
      $translatedAuthor = $queryBuilderAuthor
        ->select('uid')
        ->from(self::TABLE_AUTHOR)
        ->where(
            $queryBuilderAuthor->expr()->eq(
              'sys_language_uid',
              $queryBuilderAuthor->createNamedParameter((int)$GLOBALS['TSFE']->sys_language_uid, \PDO::PARAM_INT)
            )
          )
        ->andWhere(
            $queryBuilderAuthor->expr()->eq(
              'l10n_parent', 
              $queryBuilderAuthor->createNamedParameter((int)$authorUid, \PDO::PARAM_INT)
            )
         )
        ->setMaxResults(1)
        ->execute()
        ->fetchAll();

      if ($translatedAuthor && $translatedAuthor[0]['uid']) {
        $authorUid = $translatedAuthor[0]['uid'];
      }
    }


    // Initialize Query Builder for table 'tx_news_domain_model_news'
    /** @var QueryBuilder $queryBuilderNews */
    $queryBuilderNews = GeneralUtility::makeInstance(ConnectionPool::class)
                        ->getQueryBuilderForTable(self::TABLE_NEWS);

    $news = $queryBuilderNews
      ->select('tx_news_domain_model_news.*')
      ->from(self::TABLE_NEWS)
      ->leftJoin(
        self::TABLE_NEWS,
        self::TABLE_AUTHOR,
        'newsauthorMM',
        $queryBuilderNews->expr()->eq(
          'newsauthorMM.uid', 
          $queryBuilderNews->quoteIdentifier('tx_news_domain_model_news.uid')
        )
      )
      ->where(
        $queryBuilderNews->expr()->eq(
          'newsauthorMM.uid', 
          $queryBuilderNews->createNamedParameter((int)$authorUid, \PDO::PARAM_INT)
        )
      )
      ->execute()
      ->fetchAll();

    return $news;
  }
  
}
