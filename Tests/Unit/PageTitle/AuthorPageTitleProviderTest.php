<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Tests\Unit\PageTitle;

use Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor;
use Mediadreams\MdNewsAuthor\PageTitle\AuthorPageTitleProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

#[CoversClass(AuthorPageTitleProvider::class)]
final class AuthorPageTitleProviderTest extends UnitTestCase
{
    private AuthorPageTitleProvider $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new AuthorPageTitleProvider();
    }

    #[Test]
    public function setTitleWithFirstAndLastname(): void
    {
        $author = new NewsAuthor();
        $author->setFirstname('John');
        $author->setLastname('Doe');

        $this->subject->setTitle($author);

        self::assertSame('John Doe', $this->subject->getTitle());
    }

    #[Test]
    public function setTitleWithTitleFirstAndLastname(): void
    {
        $author = new NewsAuthor();
        $author->setTitle('Dr.');
        $author->setFirstname('John');
        $author->setLastname('Doe');

        $this->subject->setTitle($author);

        self::assertSame('Dr. John Doe', $this->subject->getTitle());
    }

    #[Test]
    public function setTitleFiltersEmptyParts(): void
    {
        $author = new NewsAuthor();
        $author->setFirstname('');
        $author->setLastname('Doe');

        $this->subject->setTitle($author);

        self::assertSame('Doe', $this->subject->getTitle());
    }

    #[Test]
    public function setTitleWithEmptyAuthorReturnsEmptyString(): void
    {
        $author = new NewsAuthor();

        $this->subject->setTitle($author);

        self::assertSame('', $this->subject->getTitle());
    }
}
