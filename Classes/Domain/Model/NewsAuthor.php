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
 * Authors
 */
class NewsAuthor extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

  /**
   * title
   *
   * @var string
   */
  protected $title = '';

  /**
   * gender
   *
   * @var string
   */
  protected $gender = '';
  
  /**
   * firstname
   *
   * @var string
   * @validate NotEmpty
   */
  protected $firstname = '';
  
  /**
   * lastname
   *
   * @var string
   * @validate NotEmpty
   */
  protected $lastname = '';
    
  /**
   * companie
   *
   * @var string
   * @validate NotEmpty
   */
  protected $companie = '';
  
  /**
   * position
   *
   * @var string
   * @validate NotEmpty
   */
  protected $position = '';
  
  /**
   * phone
   *
   * @var string
   */
  protected $phone = '';

  /**
   * email
   *
   * @var string
   */
  protected $email = '';

  /**
   * www
   *
   * @var string
   */
  protected $www = '';

  /**
   * facebook
   *
   * @var string
   */
  protected $facebook = '';

  /**
   * twitter
   *
   * @var string
   */
  protected $twitter = '';
  
  /**
   * linkedin
   *
   * @var string
   */
  protected $linkedin = '';

  /**
   * xing
   *
   * @var string
   */
  protected $xing = ''; 
   
  
  /**
   * bio
   *
   * @var string
   */
  protected $bio = '';
  
  /**
   * image
   *
   * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
   */
  protected $image;

  /**
   * categories
   *
   * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
   */
  protected $categories;

  /**
   * news
   *
   * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\News>
   * @lazy
   */
  protected $news;
  
  /**
   * Returns the gender
   *
   * @return string $gender
   */
  public function getGender()
  {
    return $this->gender;
  }
  
  /**
   * Sets the gender
   *
   * @param string $gender
   * @return void
   */
  public function setGender($gender)
  {
    $this->gender = $gender;
  }

  /**
   * Returns the title
   *
   * @return string $title
   */
  public function getTitle()
  {
    return $this->title;
  }
  
  /**
   * Sets the title
   *
   * @param string $title
   * @return void
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }
  
  /**
   * Returns the firstname
   *
   * @return string $firstname
   */
  public function getFirstname()
  {
    return $this->firstname;
  }
  
  /**
   * Sets the firstname
   *
   * @param string $firstname
   * @return void
   */
  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;
  }
  
  /**
   * Returns the lastname
   *
   * @return string $lastname
   */
  public function getLastname()
  {
    return $this->lastname;
  }
  
  /**
   * Sets the lastname
   *
   * @param string $lastname
   * @return void
   */
  public function setLastname($lastname)
  {
    $this->lastname = $lastname;
  }

  /**
   * Returns the companie
   *
   * @return string companie
   */
  public function getCompanie()
  {
    return $this->companie;
  }
  
  /**
   * Sets the companie
   *
   * @param string companie
   * @return void
   */
  public function setCompanie($companie)
  {
    $this->companie = $companie;
  }
  
  /**
   * Returns the position
   *
   * @return string position
   */
  public function getPosition()
  {
    return $this->position;
  }
  
  /**
   * Sets the position
   *
   * @param string position
   * @return void
   */
  public function setPosition($position)
  {
    $this->position = $position;
  }

  /**
   * Returns the phone numer
   *
   * @return string $phone
   */
  public function getPhone()
  {
    return $this->phone;
  }
  
  /**
   * Sets the phone number
   *
   * @param string $phone
   * @return void
   */
  public function setPhone($phone)
  {
    $this->phone = $phone;
  }

  /**
   * Returns the email
   *
   * @return string $email
   */
  public function getEmail()
  {
    return $this->email;
  }
  
  /**
   * Sets the email
   *
   * @param string $email
   * @return void
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }

  /**
   * Returns the www
   *
   * @return string $www
   */
  public function getWww()
  {
    return $this->www;
  }
  
  /**
   * Sets the www
   *
   * @param string $www
   * @return void
   */
  public function setWww($www)
  {
    $this->www = $www;
  }

  /**
   * Returns the facebook
   *
   * @return string $facebook
   */
  public function getFacebook()
  {
    return $this->facebook;
  }
  
  /**
   * Sets the facebook
   *
   * @param string $facebook
   * @return void
   */
  public function setFacebook($facebook)
  {
    $this->facebook = $facebook;
  }

  /**
   * Returns the twitter
   *
   * @return string $twitter
   */
  public function getTwitter()
  {
    return $this->twitter;
  }
  
  /**
   * Sets the twitter
   *
   * @param string $twitter
   * @return void
   */
  public function setTwitter($twitter)
  {
    $this->twitter = $twitter;
  }
    
  /**
   * Returns the linkedin
   *
   * @return string linkedin
   */
  public function getLinkedin()
  {
    return $this->linkedin;
  }
  
  /**
   * Sets the linkedin
   *
   * @param string linkedin
   * @return void
   */
  public function setLinkedin($linkedin)
  {
    $this->linkedin = $linkedin;
  }

  /**
   * Returns the xing
   *
   * @return string xing
   */
  public function getXing()
  {
    return $this->xing;
  }
  
  /**
   * Sets the xing
   *
   * @param string xing
   * @return void
   */
  public function setXing($xing)
  {
    $this->xing = $xing;
  }

  /**
   * Returns the bio
   *
   * @return string $bio
   */
  public function getBio()
  {
    return $this->bio;
  }
  
  /**
   * Sets the bio
   *
   * @param string $bio
   * @return void
   */
  public function setBio($bio)
  {
    $this->bio = $bio;
  }
  
  /**
   * Returns the image
   *
   * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
   */
  public function getImage() 
  {
    return $this->image;
  }

  /**
   * Sets the image
   *
   * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
   * @return void
   */
  public function setImage($image) 
  {
    $this->image = $image;
  }

  /**
   * Adds a Category
   *
   * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
   * @return void
   */
  public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category)
  {
    $this->categories->attach($category);
  }
 
  /**
   * Removes a Category
   *
   * @param \TYPO3\CMS\Extbase\Domain\Model\Category $categoryToRemove The Category to be removed
   * @return void
   */
  public function removeCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $categoryToRemove)
  {
    $this->categories->detach($categoryToRemove);
  }
 
  /**
   * Returns the categories
   *
   * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
   */
  public function getCategories()
  {
    return $this->categories;
  }
 
  /**
   * Sets the categories
   *
   * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
   * @return void
   */
  public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories)
  {
    $this->categories = $categories;
  }

  /**
   * Adds a News
   *
   * @param \Mediadreams\MdNewsAuthor\Domain\Model\News $news
   * @return void
   */
  public function addNews(\Mediadreams\MdNewsAuthor\Domain\Model\News $news)
  {
    $this->news->attach($news);
  }
 
  /**
   * Removes a News
   *
   * @param \Mediadreams\MdNewsAuthor\Domain\Model\News $newsToRemove The News to be removed
   * @return void
   */
  public function removeNews(\Mediadreams\MdNewsAuthor\Domain\Model\News $newsToRemove)
  {
    $this->news->detach($newsToRemove);
  }
 
  /**
   * Returns the news
   *
   * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\News> $news
   */
  public function getNews()
  {
    return $this->news;
  }
 
  /**
   * Sets the news
   *
   * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mediadreams\MdNewsAuthor\Domain\Model\News> $news
   * @return void
   */
  public function setNews(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $news)
  {
    $this->news = $news;
  }

}
