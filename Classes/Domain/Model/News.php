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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $newsAuthor = null;

    /**
     * Adds a NewsAuthor
     *
     * @param \Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor
     * @return void
     */
    public function addNewsAuthor(\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor)
    {
        $this->newsAuthor->attach($newsAuthor);
    }

    /**
     * Removes a NewsAuthor
     *
     * @param \Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthorToRemove The NewsAuthor to be removed
     * @return void
     */
    public function removeNewsAuthor(\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthorToRemove)
    {
        $this->newsAuthor->detach($newsAuthorToRemove);
    }

    /**
     * Returns the newsAuthor
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor> newsAuthor
     */
    public function getNewsAuthor()
    {
        return $this->newsAuthor;
    }

    /**
     * Sets the newsAuthor
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor> $newsAuthor
     * @return void
     */
    public function setNewsAuthor(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $newsAuthor)
    {
        $this->newsAuthor = $newsAuthor;
    }

}
