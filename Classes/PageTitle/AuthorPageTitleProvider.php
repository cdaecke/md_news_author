<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\PageTitle;

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
use Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor;
use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

/**
 * Class AuthorPageTitleProvider
 */
final class AuthorPageTitleProvider extends AbstractPageTitleProvider
{
    public function setTitle(NewsAuthor $newsAuthor): void
    {
        $this->title = trim(implode(' ', array_filter([
            $newsAuthor->getTitle(),
            $newsAuthor->getFirstname(),
            $newsAuthor->getLastname(),
        ])));
    }
}
