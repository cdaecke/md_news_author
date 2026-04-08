<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Tests\Functional\Domain\Repository;

use Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor;
use Mediadreams\MdNewsAuthor\Domain\Repository\NewsAuthorRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

#[CoversClass(NewsAuthorRepository::class)]
final class NewsAuthorRepositoryTest extends FunctionalTestCase
{
    protected array $testExtensionsToLoad = [
        'georgringer/news',
        'mediadreams/md_news_author',
    ];

    private NewsAuthorRepository $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->get(NewsAuthorRepository::class);
    }

    #[Test]
    public function isRepository(): void
    {
        self::assertInstanceOf(Repository::class, $this->subject);
    }

    #[Test]
    public function findAllForNoRecordsReturnsEmptyResult(): void
    {
        $result = $this->subject->findAll();

        self::assertCount(0, $result);
    }

    #[Test]
    public function findAllSortsByLastnameInAscendingOrder(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsAuthorRepository/findAll/TwoUnsortedAuthors.csv');

        $result = $this->subject->findAll();

        $result->rewind();
        self::assertSame(2, $result->current()->getUid());
    }

    #[Test]
    public function findAllReturnsNewsAuthorObjects(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsAuthorRepository/findAll/TwoUnsortedAuthors.csv');

        $result = $this->subject->findAll();

        $result->rewind();
        self::assertInstanceOf(NewsAuthor::class, $result->current());
    }

    #[Test]
    public function getAuthorsByInitialThrowsExceptionForEmptyInitial(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(1496613849);

        $this->subject->getAuthorsByInitial('');
    }

    #[Test]
    public function getAuthorsByInitialFindsAuthorsWithMatchingInitial(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsAuthorRepository/getAuthorsByInitial/AuthorsWithDifferentInitials.csv');

        $result = $this->subject->getAuthorsByInitial('D');

        self::assertCount(1, $result);
    }

    #[Test]
    public function getAuthorsByInitialIgnoresAuthorsWithNonMatchingInitial(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsAuthorRepository/getAuthorsByInitial/AuthorsWithDifferentInitials.csv');

        $result = $this->subject->getAuthorsByInitial('X');

        self::assertCount(0, $result);
    }

    #[Test]
    public function getAuthorsByInitialMapsAuthorData(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsAuthorRepository/getAuthorsByInitial/AuthorsWithDifferentInitials.csv');

        $result = $this->subject->getAuthorsByInitial('D');

        $result->rewind();
        $author = $result->current();
        self::assertInstanceOf(NewsAuthor::class, $author);
        self::assertSame('Doe', $author->getLastname());
        self::assertSame('Jane', $author->getFirstname());
    }

    #[Test]
    public function getAuthorsByCategoriesThrowsExceptionForEmptyCategories(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(1494071855);

        $this->subject->getAuthorsByCategories('');
    }

    #[Test]
    public function getAuthorsByCategoriesFindsAuthorWithMatchingCategory(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsAuthorRepository/getAuthorsByCategories/AuthorWithCategory.csv');

        $result = $this->subject->getAuthorsByCategories('1');

        self::assertCount(1, $result);
    }

    #[Test]
    public function getAuthorsByCategoriesIgnoresAuthorWithNonMatchingCategory(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsAuthorRepository/getAuthorsByCategories/AuthorWithCategory.csv');

        $result = $this->subject->getAuthorsByCategories('99');

        self::assertCount(0, $result);
    }

    #[Test]
    public function getAuthorsByCategoriesWithInitialFiltersAdditionally(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsAuthorRepository/getAuthorsByCategories/TwoAuthorsWithSameCategory.csv');

        $result = $this->subject->getAuthorsByCategories('1', 'D');

        self::assertCount(1, $result);
        $result->rewind();
        self::assertSame('Doe', $result->current()->getLastname());
    }
}
