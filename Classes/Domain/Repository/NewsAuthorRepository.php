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
 * The repository for NewsAuthors
 */
class NewsAuthorRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

  protected $defaultOrderings = array(
    'lastname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
  );

  /**
   * Get authors according to the initial of the lastname
   *
   * @param string $initial Initial of lastname
   * @return QueryInterface
   */
  public function getAuthorsByInitial($initial) {
    if (empty($initial)) {
      throw new \InvalidArgumentException('No initial for lastname given.', 1496613849);
    }

    $query = $this->createQuery();

    $query->matching(
      $query->logicalAnd(
        $query->like('lastname', $initial . '%')
      )
    );

    return $query->execute();
  }

  /**
   * Get authors according to categories
   *
   * @param string $categories Comma separated UIDs of categories
   * @param string $initial Initial of lastname
   * @return QueryInterface
   */
  public function getAuthorsByCategories($categories='', $initial='') {
    if (empty($categories)) {
      throw new \InvalidArgumentException('No categories given.', 1494071855);
    }

    $constraint = array();
    $query = $this->createQuery();

    if (!is_array($categories)) {
      $categories = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $categories, true);
    }

    foreach ($categories as $category) {
      $categoryConstraints[] = $query->contains('categories', $category);
    }

    $constraint[] = $query->logicalOr($categoryConstraints);

    if (!empty($initial)) {
      $constraint[] = $query->logicalAnd(
        $query->like('lastname', $initial . '%')
      );
    }
    
    if (!empty($constraint)) {
      $query->matching(
        $query->logicalAnd($constraint)
      );
    }

    return $query->execute();
  }
  
}
