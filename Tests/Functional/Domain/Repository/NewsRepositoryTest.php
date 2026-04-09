<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Tests\Functional\Domain\Repository;

use Mediadreams\MdNewsAuthor\Domain\Repository\NewsRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

#[CoversClass(NewsRepository::class)]
final class NewsRepositoryTest extends FunctionalTestCase
{
    protected array $testExtensionsToLoad = [
        'georgringer/news',
        'mediadreams/md_news_author',
    ];

    private NewsRepository $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->get(NewsRepository::class);
    }

    #[Test]
    public function isRepository(): void
    {
        self::assertInstanceOf(Repository::class, $this->subject);
    }

    #[Test]
    public function getNewsByAuthorForNoRecordsReturnsEmptyResult(): void
    {
        $result = $this->subject->getNewsByAuthor(1);

        self::assertCount(0, $result);
    }

    #[Test]
    public function getNewsByAuthorFindsNewsAssignedToAuthor(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsRepository/getNewsByAuthor/NewsWithAuthor.csv');

        $result = $this->subject->getNewsByAuthor(1);

        self::assertCount(1, $result);
    }

    #[Test]
    public function getNewsByAuthorIgnoresNewsWithoutMatchingAuthor(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsRepository/getNewsByAuthor/NewsWithAuthor.csv');

        $result = $this->subject->getNewsByAuthor(99);

        self::assertCount(0, $result);
    }

    #[Test]
    public function getNewsByAuthorIgnoresNewsNotAssignedToAnyAuthor(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/NewsRepository/getNewsByAuthor/NewsWithoutAuthor.csv');

        $result = $this->subject->getNewsByAuthor(1);

        self::assertCount(0, $result);
    }
}
