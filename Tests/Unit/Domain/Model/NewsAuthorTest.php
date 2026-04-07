<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Tests\Unit\Domain\Model;

use Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

#[CoversClass(NewsAuthor::class)]
final class NewsAuthorTest extends UnitTestCase
{
    private NewsAuthor $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new NewsAuthor();
    }

    #[Test]
    public function isAbstractEntity(): void
    {
        self::assertInstanceOf(AbstractEntity::class, $this->subject);
    }

    #[Test]
    public function getTitleInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getTitle());
    }

    #[Test]
    public function setTitleSetsTitle(): void
    {
        $value = 'Dr.';
        $this->subject->setTitle($value);

        self::assertSame($value, $this->subject->getTitle());
    }

    #[Test]
    public function getGenderInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getGender());
    }

    #[Test]
    public function setGenderSetsGender(): void
    {
        $value = 'm';
        $this->subject->setGender($value);

        self::assertSame($value, $this->subject->getGender());
    }

    #[Test]
    public function getFirstnameInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getFirstname());
    }

    #[Test]
    public function setFirstnameSetsFirstname(): void
    {
        $value = 'John';
        $this->subject->setFirstname($value);

        self::assertSame($value, $this->subject->getFirstname());
    }

    #[Test]
    public function getLastnameInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getLastname());
    }

    #[Test]
    public function setLastnameSetsLastname(): void
    {
        $value = 'Doe';
        $this->subject->setLastname($value);

        self::assertSame($value, $this->subject->getLastname());
    }

    #[Test]
    public function getSlugInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getSlug());
    }

    #[Test]
    public function setSlugSetsSlug(): void
    {
        $value = 'john-doe';
        $this->subject->setSlug($value);

        self::assertSame($value, $this->subject->getSlug());
    }

    #[Test]
    public function getCompanyInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getCompany());
    }

    #[Test]
    public function setCompanySetsCompany(): void
    {
        $value = 'Acme Corp';
        $this->subject->setCompany($value);

        self::assertSame($value, $this->subject->getCompany());
    }

    #[Test]
    public function getPositionInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getPosition());
    }

    #[Test]
    public function setPositionSetsPosition(): void
    {
        $value = 'Editor';
        $this->subject->setPosition($value);

        self::assertSame($value, $this->subject->getPosition());
    }

    #[Test]
    public function getPhoneInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getPhone());
    }

    #[Test]
    public function setPhoneSetsPhone(): void
    {
        $value = '+49 123 456789';
        $this->subject->setPhone($value);

        self::assertSame($value, $this->subject->getPhone());
    }

    #[Test]
    public function getEmailInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getEmail());
    }

    #[Test]
    public function setEmailSetsEmail(): void
    {
        $value = 'john@example.com';
        $this->subject->setEmail($value);

        self::assertSame($value, $this->subject->getEmail());
    }

    #[Test]
    public function getWwwInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getWww());
    }

    #[Test]
    public function setWwwSetsWww(): void
    {
        $value = 'https://example.com';
        $this->subject->setWww($value);

        self::assertSame($value, $this->subject->getWww());
    }

    #[Test]
    public function getFacebookInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getFacebook());
    }

    #[Test]
    public function setFacebookSetsFacebook(): void
    {
        $value = 'johndoe';
        $this->subject->setFacebook($value);

        self::assertSame($value, $this->subject->getFacebook());
    }

    #[Test]
    public function getTwitterInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getTwitter());
    }

    #[Test]
    public function setTwitterSetsTwitter(): void
    {
        $value = '@johndoe';
        $this->subject->setTwitter($value);

        self::assertSame($value, $this->subject->getTwitter());
    }

    #[Test]
    public function getLinkedinInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getLinkedin());
    }

    #[Test]
    public function setLinkedinSetsLinkedin(): void
    {
        $value = 'john-doe';
        $this->subject->setLinkedin($value);

        self::assertSame($value, $this->subject->getLinkedin());
    }

    #[Test]
    public function getXingInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getXing());
    }

    #[Test]
    public function setXingSetsXing(): void
    {
        $value = 'john_doe';
        $this->subject->setXing($value);

        self::assertSame($value, $this->subject->getXing());
    }

    #[Test]
    public function getBioInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getBio());
    }

    #[Test]
    public function setBioSetsBio(): void
    {
        $value = 'John Doe is an experienced editor.';
        $this->subject->setBio($value);

        self::assertSame($value, $this->subject->getBio());
    }

    #[Test]
    public function getImageInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getImage());
    }

    #[Test]
    public function setImageSetsImage(): void
    {
        $image = new FileReference();
        $this->subject->setImage($image);

        self::assertSame($image, $this->subject->getImage());
    }

    #[Test]
    public function setImageAcceptsNull(): void
    {
        $this->subject->setImage(null);

        self::assertNull($this->subject->getImage());
    }
}
