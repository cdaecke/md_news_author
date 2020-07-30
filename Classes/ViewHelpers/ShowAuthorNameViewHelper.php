<?php
namespace Mediadreams\MdNewsAuthor\ViewHelpers;


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

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ViewHelper to show author name with optional title
 *
 * # Example: Basic example
 *
 * <code>
 * <md:ShowAuthorName author="{newsItem.newsAuthor}" />
 * OR inline
 * {md:ShowAuthorName(author: newsAuthor)}
 * </code>
 * <output>
 * {Title} Firstname Lastname
 * </output>
 *
 * @package MdNewsAuthor
 * @subpackage ViewHelpers
 * @author Christoph Daecke <typo3@mediadreams.org>
 *
 */
class ShowAuthorNameViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('author', 'object', 'the author object', true);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    )
    {
        if (!is_object($arguments['author'])) {
            return '';
        }

        $author = $arguments['author'];

        $authorTitle = $author->getTitle();
        $fullAuthor = $author->getFirstname().' '.$author->getLastname();

        if ($authorTitle) {
            $fullAuthor = $authorTitle.' '.$fullAuthor;
        }

        return $fullAuthor;
    }
  
}
