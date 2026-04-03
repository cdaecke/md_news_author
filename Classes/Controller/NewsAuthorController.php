<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Controller;

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

use Mediadreams\MdNewsAuthor\Domain\Repository\NewsAuthorRepository;
use Mediadreams\MdNewsAuthor\Domain\Repository\NewsRepository;
use Mediadreams\MdNewsAuthor\PageTitle\AuthorPageTitleProvider;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

/**
 * NewsAuthorController
 */
class NewsAuthorController extends ActionController
{
    public function __construct(
        protected NewsAuthorRepository $newsAuthorRepository,
        protected NewsRepository $newsRepository,
        protected AuthorPageTitleProvider $titleProvider
    )
    { }

    public function listAction(string $selectedLetter = '', int $currentPage = 1): ResponseInterface
    {
        $categoriesList = $this->settings['categoriesList'] ?? '';

        // Load all authors once. We need the full set to build the active-letters
        // navigation regardless of any letter filter being applied.
        $allAuthors = $categoriesList !== ''
            ? $this->newsAuthorRepository->getAuthorsByCategories($categoriesList)
            : $this->newsAuthorRepository->findAll();

        // Build active letters and the filtered list in a single pass — no second query.
        $normalizedLetter = mb_strtoupper($selectedLetter);
        $activeLetters = [];
        $filteredAuthors = [];

        foreach ($allAuthors as $author) {
            $char = mb_strtoupper(mb_substr($author->getLastname(), 0, 1, 'UTF-8'));
            $activeLetters[$char] = true;
            if ($normalizedLetter === '' || $char === $normalizedLetter) {
                $filteredAuthors[] = $author;
            }
        }

        $this->view->assign('activeLetters', $activeLetters);
        $this->view->assign('selectedLetter', $normalizedLetter);
        $this->view->assign('letters', explode(',', $this->settings['authorList']['letters']));

        $this->assignPagination(
            $filteredAuthors,
            (int)$this->settings['authorList']['paginate']['itemsPerPage'],
            (int)$this->settings['authorList']['paginate']['maximumNumberOfLinks']
        );

        return $this->htmlResponse();
    }

    public function showAction(?\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor = null): ResponseInterface
    {
        if ($newsAuthor != null) {
            $this->titleProvider->setTitle($newsAuthor);
            $this->view->assign('newsAuthor', $newsAuthor);

            $this->assignPagination(
                $this->newsRepository->getNewsByAuthor($newsAuthor->getUid()),
                (int)$this->settings['authorDetail']['paginate']['itemsPerPage'],
                (int)$this->settings['authorDetail']['paginate']['maximumNumberOfLinks']
            );
        } else {
            if ($this->settings['listPid']) {
                $uriBuilder = $this->uriBuilder;
                $uri = $uriBuilder
                    ->setTargetPageUid((int)$this->settings['listPid'])
                    ->build();

                return $this->redirectToUri($uri, 0, 308);
            }
        }

        return $this->htmlResponse();
    }

    protected function assignPagination(array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface $items, int $itemsPerPage = 10, int $maximumNumberOfLinks = 5): void
    {
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;

        $paginator = is_array($items)
            ? new ArrayPaginator($items, $currentPage, $itemsPerPage)
            : new QueryResultPaginator($items, $currentPage, $itemsPerPage);

        $pagination = new SlidingWindowPagination(
            $paginator,
            $maximumNumberOfLinks
        );

        $this->view->assign('pagination', [
            'paginator' => $paginator,
            'pagination' => $pagination,
        ]);
    }
}
