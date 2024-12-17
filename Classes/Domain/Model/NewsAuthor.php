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

use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Authors
 */
class NewsAuthor extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected string $title = '';

    /**
     * gender
     *
     * @var string
     */
    protected string $gender = '';

    /**
     * firstname
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected string $firstname = '';

    /**
     * lastname
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected string $lastname = '';

    /**
     * slug
     *
     * @var string
     */
    protected string $slug = '';

    /**
     * company
     *
     * @var string
     */
    protected string $company = '';

    /**
     * position
     *
     * @var string
     */
    protected string $position = '';

    /**
     * phone
     *
     * @var string
     */
    protected string $phone = '';

    /**
     * email
     *
     * @var string
     */
    protected string $email = '';

    /**
     * www
     *
     * @var string
     */
    protected string $www = '';

    /**
     * facebook
     *
     * @var string
     */
    protected string $facebook = '';

    /**
     * twitter
     *
     * @var string
     */
    protected string $twitter = '';

    /**
     * linkedin
     *
     * @var string
     */
    protected string $linkedin = '';

    /**
     * xing
     *
     * @var string
     */
    protected string $xing = '';

    /**
     * bio
     *
     * @var string
     */
    protected string $bio = '';

    /**
     * image
     *
     * @var FileReference|null
     */
    protected ?FileReference $image;

    /**
     * categories
     *
     * @var ObjectStorage<Category>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected ObjectStorage $categories;

    /**
     * news
     *
     * @var ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\News>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
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

    /**
     * Returns the gender
     *
     * @return string $gender
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * Sets the gender
     *
     * @param string $gender
     * @return void
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Returns the firstname
     *
     * @return string $firstname
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Sets the firstname
     *
     * @param string $firstname
     * @return void
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * Returns the lastname
     *
     * @return string $lastname
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Sets the lastname
     *
     * @param string $lastname
     * @return void
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * Returns the slug
     *
     * @return string $slug
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Sets the slug
     *
     * @param string $slug
     * @return void
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Returns the company
     *
     * @return string $company
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * Sets the company
     *
     * @param string $company
     * @return void
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * Returns the position
     *
     * @return string $position
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * Sets the position
     *
     * @param string $position
     * @return void
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * Returns the phone number
     *
     * @return string $phone
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Sets the phone number
     *
     * @param string $phone
     * @return void
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Returns the www
     *
     * @return string $www
     */
    public function getWww(): string
    {
        return $this->www;
    }

    /**
     * Sets the www
     *
     * @param string $www
     * @return void
     */
    public function setWww(string $www): void
    {
        $this->www = $www;
    }

    /**
     * Returns the facebook
     *
     * @return string $facebook
     */
    public function getFacebook(): string
    {
        return $this->facebook;
    }

    /**
     * Sets the facebook
     *
     * @param string $facebook
     * @return void
     */
    public function setFacebook(string $facebook): void
    {
        $this->facebook = $facebook;
    }

    /**
     * Returns the twitter
     *
     * @return string $twitter
     */
    public function getTwitter(): string
    {
        return $this->twitter;
    }

    /**
     * Sets the twitter
     *
     * @param string $twitter
     * @return void
     */
    public function setTwitter(string $twitter): void
    {
        $this->twitter = $twitter;
    }

    /**
     * Returns the linkedin
     *
     * @return string $linkedin
     */
    public function getLinkedin(): string
    {
        return $this->linkedin;
    }

    /**
     * Sets the linkedin
     *
     * @param string $linkedin
     * @return void
     */
    public function setLinkedin(string $linkedin): void
    {
        $this->linkedin = $linkedin;
    }

    /**
     * Returns the xing
     *
     * @return string $xing
     */
    public function getXing(): string
    {
        return $this->xing;
    }

    /**
     * Sets the xing
     *
     * @param string $xing
     * @return void
     */
    public function setXing(string $xing): void
    {
        $this->xing = $xing;
    }

    /**
     * Returns the bio
     *
     * @return string $bio
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * Sets the bio
     *
     * @param string $bio
     * @return void
     */
    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    /**
     * Returns the image
     *
     * @return FileReference|null $image
     */
    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param FileReference|null $image
     * @return void
     */
    public function setImage(?FileReference $image): void
    {
        $this->image = $image;
    }

    /**
     * Adds a Category
     *
     * @param Category $category
     * @return void
     */
    public function addCategory(Category $category): void
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a Category
     *
     * @param Category $categoryToRemove The Category to be removed
     * @return void
     */
    public function removeCategory(Category $categoryToRemove): void
    {
        $this->categories->detach($categoryToRemove);
    }

    /**
     * Returns the categories
     *
     * @return ObjectStorage<Category> $categories
     */
    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    /**
     * Sets the categories
     *
     * @param ObjectStorage<Category> $categories
     * @return void
     */
    public function setCategories(ObjectStorage $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * Adds a News
     *
     * @param \Mediadreams\MdNewsAuthor\Domain\Model\News $news
     * @return void
     */
    public function addNews(\Mediadreams\MdNewsAuthor\Domain\Model\News $news): void
    {
        $this->news->attach($news);
    }

    /**
     * Removes a News
     *
     * @param \Mediadreams\MdNewsAuthor\Domain\Model\News $newsToRemove The News to be removed
     * @return void
     */
    public function removeNews(\Mediadreams\MdNewsAuthor\Domain\Model\News $newsToRemove): void
    {
        $this->news->detach($newsToRemove);
    }

    /**
     * Returns the news
     *
     * @return ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\News>|null $news
     */
    public function getNews(): ?ObjectStorage
    {
        return $this->news;
    }

    /**
     * Sets the news
     *
     * @param ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\News> $news
     * @return void
     */
    public function setNews(ObjectStorage $news): void
    {
        $this->news = $news;
    }
}
