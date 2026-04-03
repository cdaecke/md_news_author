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
use Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor;
use Mediadreams\MdNewsAuthor\Domain\Repository\NewsAuthorRepository;
use Mediadreams\MdNewsAuthor\Domain\Repository\NewsRepository;
use Mediadreams\MdNewsAuthor\PageTitle\AuthorPageTitleProvider;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * NewsAuthorController
 */
class NewsAuthorController extends ActionController
{
    public function __construct(
        protected NewsAuthorRepository $newsAuthorRepository,
        protected NewsRepository $newsRepository,
        protected AuthorPageTitleProvider $titleProvider
    ) {}

    public function listAction(string $selectedLetter = '', int $currentPage = 1): ResponseInterface
    {
        $categoriesList = $this->settings['categoriesList'] ?? '';

        // Load all authors once. We need the full set to build the active-letters
        // navigation regardless of any letter filter being applied.
        $allAuthors = $categoriesList !== ''
            ? $this->newsAuthorRepository->getAuthorsByCategories($categoriesList)
            : $this->newsAuthorRepository->findAll();

        $normalizedLetter = mb_strtoupper($selectedLetter);
        ['activeLetters' => $activeLetters, 'filteredAuthors' => $filteredAuthors] = $this->buildLetterFilter($allAuthors, $normalizedLetter);

        $this->view->assign('activeLetters', $activeLetters);
        $this->view->assign('selectedLetter', $normalizedLetter);
        $this->view->assign('letters', explode(',', (string)$this->settings['authorList']['letters']));

        $this->assignPagination(
            $filteredAuthors,
            (int)$this->settings['authorList']['paginate']['itemsPerPage'],
            (int)$this->settings['authorList']['paginate']['maximumNumberOfLinks']
        );

        return $this->htmlResponse();
    }

    public function showAction(?NewsAuthor $newsAuthor = null): ResponseInterface
    {
        if ($newsAuthor === null) {
            return $this->redirectToList() ?? $this->htmlResponse();
        }

        $this->titleProvider->setTitle($newsAuthor);
        $this->view->assign('newsAuthor', $newsAuthor);

        $uid = $newsAuthor->getUid();
        if ($uid !== null) {
            $this->assignPagination(
                $this->newsRepository->getNewsByAuthor($uid),
                (int)$this->settings['authorDetail']['paginate']['itemsPerPage'],
                (int)$this->settings['authorDetail']['paginate']['maximumNumberOfLinks']
            );
        }

        return $this->htmlResponse();
    }

    /**
     * Build active-letters index and filtered author list in a single pass.
     *
     * @param iterable<NewsAuthor> $authors
     * @return array{activeLetters: array<string, bool>, filteredAuthors: list<NewsAuthor>}
     */
    private function buildLetterFilter(iterable $authors, string $normalizedLetter): array
    {
        $activeLetters = [];
        $filteredAuthors = [];

        foreach ($authors as $author) {
            /** @var NewsAuthor $author */
            $char = mb_strtoupper(mb_substr($author->getLastname(), 0, 1, 'UTF-8'));
            $activeLetters[$char] = true;
            if ($normalizedLetter === '' || $char === $normalizedLetter) {
                $filteredAuthors[] = $author;
            }
        }

        return ['activeLetters' => $activeLetters, 'filteredAuthors' => $filteredAuthors];
    }

    /**
     * Redirect to the configured list page, or return null if no listPid is set.
     */
    private function redirectToList(): ?ResponseInterface
    {
        if (!$this->settings['listPid']) {
            return null;
        }

        $uri = $this->uriBuilder
            ->setTargetPageUid((int)$this->settings['listPid'])
            ->build();

        return $this->redirectToUri($uri, null, 308);
    }

    protected function assignPagination(array|QueryResultInterface $items, int $itemsPerPage = 10, int $maximumNumberOfLinks = 5): void
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
