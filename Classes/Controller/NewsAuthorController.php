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


/**
 * NewsAuthorController
 */
class NewsAuthorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * newsAuthorRepository
     *
     * @var \Mediadreams\MdNewsAuthor\Domain\Repository\NewsAuthorRepository
     * @inject
     */
    protected $newsAuthorRepository = NULL;

    /**
     * newsRepository
     *
     * @var \Mediadreams\MdNewsAuthor\Domain\Repository\NewsRepository
     * @inject
     */
    protected $newsRepository;
  
    /**
     * action list
     *
     * @param string $selectedLetter
     * @return void
     */
    public function listAction($selectedLetter="")
    {
        // get all authors
        // we need all authors all the time because the alphabetical filter needs them as well
        if ($this->settings['categoriesList'] != '') {
            $newsAuthors = $this->newsAuthorRepository->getAuthorsByCategories($this->settings['categoriesList']);
        } else {
            $newsAuthors = $this->newsAuthorRepository->findAll();
        }

        $activeLetters = array();
        foreach($newsAuthors as $author){
            $char = mb_substr($author->getLastname(),0,1, "UTF-8");
            $activeLetters[$char] = true;
        }
        $this->view->assign('activeLetters', $activeLetters);
        $this->view->assign('selectedLetter', $selectedLetter);

        // assign selected authors only
        // we need to query again because of the selected letter
        if (!empty($selectedLetter)) {
            if ($this->settings['categoriesList'] != '') {
                $newsAuthors = $this->newsAuthorRepository->getAuthorsByCategories($this->settings['categoriesList'], $selectedLetter);
            } else {
                $newsAuthors = $this->newsAuthorRepository->getAuthorsByInitial($selectedLetter);
            }
        }

        $this->view->assign('newsAuthors', $newsAuthors);
    }
  
    /**
     * action show
     *
     * @param \Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor
     * @return void
     */
    public function showAction(\Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor $newsAuthor)
    {
        // write page title
        $pageTitle = $newsAuthor->getTitle().' '.$newsAuthor->getFirstname().' '.$newsAuthor->getLastname();
        $GLOBALS['TSFE']->page['title'] = $pageTitle;
        $GLOBALS['TSFE']->indexedDocTitle = $pageTitle;

        $this->view->assignMultiple([
            'newsAuthor' => $newsAuthor,
            'authorNews' => $this->newsRepository->getNewsByAuthor($newsAuthor->getUid())
        ]);
    }

}
