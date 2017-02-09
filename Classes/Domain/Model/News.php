<?php
namespace Mediadreams\MdNewsAuthor\Domain\Model;


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
 * News
 */
class News extends \GeorgRinger\News\Domain\Model\News
{

  /**
   * newsAuthor
   *
   * @var \Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor
   */
  protected $newsAuthor = null;
  
  /**
   * Returns the newsAuthor
   *
   * @return \Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor
   */
  public function getNewsAuthor()
  {
    return $this->newsAuthor;
  }
  
  /**
   * Sets the newsAuthor
   *
   * @param \Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor
   * @return void
   */
  public function setNewsAuthor(\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor)
  {
    $this->newsAuthor = $newsAuthor;
  }

}
