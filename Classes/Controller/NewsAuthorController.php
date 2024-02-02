<?php

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

use GeorgRinger\NumberedPagination\NumberedPagination;
use Mediadreams\MdNewsAuthor\Domain\Repository\NewsAuthorRepository;
use Mediadreams\MdNewsAuthor\Domain\Repository\NewsRepository;
use Mediadreams\MdNewsAuthor\PageTitle\AuthorPageTitleProvider;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

/**
 * NewsAuthorController
 */
class NewsAuthorController extends ActionController
{

    /**
     * newsAuthorRepository
     *
     * @var NewsAuthorRepository
     */
    protected $newsAuthorRepository;

    /**
     * newsRepository
     *
     * @var NewsRepository
     */
    protected $newsRepository;

    /**
     * titleProvider
     *
     * @var AuthorPageTitleProvider
     */
    protected $titleProvider;

    /**
     * NewsAuthorController constructor.
     *
     * @param NewsAuthorRepository $newsAuthorRepository
     * @param NewsRepository $newsRepository
     * @param AuthorPageTitleProvider $titleProvider
     */
    public function __construct(
        NewsAuthorRepository $newsAuthorRepository,
        NewsRepository $newsRepository,
        AuthorPageTitleProvider $titleProvider
    ) {
        $this->newsAuthorRepository = $newsAuthorRepository;
        $this->newsRepository = $newsRepository;
        $this->titleProvider = $titleProvider;
    }

    /**
     * action list
     *
     * @param string $selectedLetter
     * @param int $currentPage
     * @return ResponseInterface
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    public function listAction($selectedLetter = "", int $currentPage = 1): ResponseInterface
    {
        // get all authors
        // we need all authors all the time because the alphabetical filter needs them as well
        if ($this->settings['categoriesList'] != '') {
            $newsAuthors = $this->newsAuthorRepository->getAuthorsByCategories($this->settings['categoriesList']);
        } else {
            $newsAuthors = $this->newsAuthorRepository->findAll();
        }

        $activeLetters = array();
        foreach ($newsAuthors as $author) {
            $char = mb_strtoupper(mb_substr($author->getLastname(), 0, 1, "UTF-8"));
            $activeLetters[$char] = true;
        }
        $this->view->assign('activeLetters', $activeLetters);
        $this->view->assign('selectedLetter', mb_strtoupper($selectedLetter));
        $this->view->assign('letters', explode(',', $this->settings['authorList']['letters']) );

        // assign selected authors only
        // we need to query again because of the selected letter
        if (!empty($selectedLetter)) {
            if ($this->settings['categoriesList'] != '') {
                $newsAuthors = $this->newsAuthorRepository->getAuthorsByCategories($this->settings['categoriesList'], $selectedLetter);
            } else {
                $newsAuthors = $this->newsAuthorRepository->getAuthorsByInitial($selectedLetter);
            }
        }

        $this->assignPagination(
            $newsAuthors,
            $this->settings['authorList']['paginate']['itemsPerPage'],
            $this->settings['authorList']['paginate']['maximumNumberOfLinks']
        );

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor|null $newsAuthor
     * @return ResponseInterface
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    public function showAction(\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor = null): ResponseInterface
    {
        if ($newsAuthor != null) {
            $this->titleProvider->setTitle($newsAuthor);
            $this->view->assign('newsAuthor', $newsAuthor);

            $this->assignPagination(
                $this->newsRepository->getNewsByAuthor($newsAuthor->getUid()),
                $this->settings['authorDetail']['paginate']['itemsPerPage'],
                $this->settings['authorDetail']['paginate']['maximumNumberOfLinks']
            );
        } else {
            if ($this->settings['listPid']) {
                $uriBuilder = $this->uriBuilder;
                $uri = $uriBuilder
                    ->setTargetPageUid($this->settings['listPid'])
                    ->build();

                $this->redirectToUri($uri, 0, 308);
            }
        }

        return $this->htmlResponse();
    }

    /**
     * Assign pagination to current view object
     *
     * @param $items
     * @param int $itemsPerPage
     * @param int $maximumNumberOfLinks
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    protected function assignPagination($items, $itemsPerPage = 10, $maximumNumberOfLinks = 5)
    {
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;

        $paginator = new QueryResultPaginator(
            $items,
            $currentPage,
            $itemsPerPage
        );

        $pagination = new NumberedPagination(
            $paginator,
            $maximumNumberOfLinks
        );

        $this->view->assign('pagination', [
            'paginator' => $paginator,
            'pagination' => $pagination,
        ]);
    }
}
