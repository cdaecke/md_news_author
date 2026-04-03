<?php

declare(strict_types=1);

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

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Authors
 */
class NewsAuthor extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    protected string $title = '';

    protected string $gender = '';

    #[Validate(['validator' => 'NotEmpty'])]
    protected string $firstname = '';

    #[Validate(['validator' => 'NotEmpty'])]
    protected string $lastname = '';

    protected string $slug = '';

    protected string $company = '';

    protected string $position = '';

    protected string $phone = '';

    protected string $email = '';

    protected string $www = '';

    protected string $facebook = '';

    protected string $twitter = '';

    protected string $linkedin = '';

    protected string $xing = '';

    protected string $bio = '';

    protected ?FileReference $image = null;

    /**
     * @var ObjectStorage<Category>
     */
    #[Lazy()]
    protected ObjectStorage $categories;

    /**
     * @var ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\News>
     */
    #[Lazy()]
    protected ObjectStorage $news;

    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * Initialize all ObjectStorages
     */
    public function initializeObject(): void
    {
        $this->categories = new ObjectStorage();
        $this->news = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getWww(): string
    {
        return $this->www;
    }

    public function setWww(string $www): void
    {
        $this->www = $www;
    }

    public function getFacebook(): string
    {
        return $this->facebook;
    }

    public function setFacebook(string $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getTwitter(): string
    {
        return $this->twitter;
    }

    public function setTwitter(string $twitter): void
    {
        $this->twitter = $twitter;
    }

    public function getLinkedin(): string
    {
        return $this->linkedin;
    }

    public function setLinkedin(string $linkedin): void
    {
        $this->linkedin = $linkedin;
    }

    public function getXing(): string
    {
        return $this->xing;
    }

    public function setXing(string $xing): void
    {
        $this->xing = $xing;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function setImage(?FileReference $image): void
    {
        $this->image = $image;
    }

    public function addCategory(Category $category): void
    {
        $this->categories->attach($category);
    }

    public function removeCategory(Category $categoryToRemove): void
    {
        $this->categories->detach($categoryToRemove);
    }

    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    public function setCategories(ObjectStorage $categories): void
    {
        $this->categories = $categories;
    }

    public function addNews(\Mediadreams\MdNewsAuthor\Domain\Model\News $news): void
    {
        $this->news->attach($news);
    }

    public function removeNews(\Mediadreams\MdNewsAuthor\Domain\Model\News $newsToRemove): void
    {
        $this->news->detach($newsToRemove);
    }

    public function getNews(): ?ObjectStorage
    {
        return $this->news;
    }

    public function setNews(ObjectStorage $news): void
    {
        $this->news = $news;
    }
}
