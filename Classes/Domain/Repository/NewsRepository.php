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
   * @param integer $authorUid
   * @return Ambigous <\TYPO3\CMS\Extbase\Persistence\QueryResultInterface, multitype:>
   */
  public function getNewsByAuthor($authorUid)
  {
    $query = $this->createQuery();

    $query->matching(
      $query->equals('news_author', $authorUid)
    );

    return $query->execute();
  }
}
