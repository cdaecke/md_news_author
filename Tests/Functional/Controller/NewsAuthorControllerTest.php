<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Tests\Functional\Controller;

use Mediadreams\MdNewsAuthor\Controller\NewsAuthorController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;

#[CoversClass(NewsAuthorController::class)]
final class NewsAuthorControllerTest extends AbstractFrontendControllerTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/ContentElements.csv'
        );
    }

    #[Test]
    public function listActionReturnsSuccessfulResponse(): void
    {
        $request = (new InternalRequest())->withPageId(2);

        $response = $this->executeFrontendSubRequest($request);

        self::assertSame(200, $response->getStatusCode());
    }

    #[Test]
    public function listActionRendersAuthorName(): void
    {
        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/listAction/AuthorOnPage.csv'
        );

        $request = (new InternalRequest())->withPageId(2);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringContainsString('Doe', $html);
    }

    #[Test]
    public function listActionWithSelectedLetterShowsOnlyMatchingAuthor(): void
    {
        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/listAction/TwoAuthorsForLetterFilter.csv'
        );

        $request = (new InternalRequest())->withPageId(2)->withQueryParameters([
            'tx_mdnewsauthor_list[selectedLetter]' => 'D',
        ]);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringContainsString('Doe', $html);
        self::assertStringNotContainsString('Smith', $html);
    }

    #[Test]
    public function showActionReturnsSuccessfulResponse(): void
    {
        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/showAction/AuthorForShow.csv'
        );

        $request = (new InternalRequest())->withPageId(3)->withQueryParameters([
            'tx_mdnewsauthor_show[newsAuthor]' => '1',
        ]);

        $response = $this->executeFrontendSubRequest($request);

        self::assertSame(200, $response->getStatusCode());
    }

    #[Test]
    public function showActionRendersAuthorDetails(): void
    {
        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/showAction/AuthorForShow.csv'
        );

        $request = (new InternalRequest())->withPageId(3)->withQueryParameters([
            'tx_mdnewsauthor_show[newsAuthor]' => '1',
        ]);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringContainsString('Jane', $html);
        self::assertStringContainsString('Doe', $html);
    }

    #[Test]
    public function showActionSetsAuthorNameAsPageTitle(): void
    {
        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/showAction/AuthorForShow.csv'
        );

        $request = (new InternalRequest())->withPageId(3)->withQueryParameters([
            'tx_mdnewsauthor_show[newsAuthor]' => '1',
        ]);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringContainsString('<title>Jane Doe', $html);
    }

    #[Test]
    public function showActionWithoutAuthorReturnsSuccessfulResponse(): void
    {
        $request = (new InternalRequest())->withPageId(3);

        $response = $this->executeFrontendSubRequest($request);

        self::assertSame(200, $response->getStatusCode());
    }


    #[Test]
    public function listActionWithCategoriesListFlexFormOnlyShowsAuthorsFromConfiguredCategory(): void
    {
        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/listAction/AuthorsWithCategory.csv'
        );

        $request = (new InternalRequest())->withPageId(4);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringContainsString('Doe', $html);
        self::assertStringNotContainsString('Smith', $html);
    }

    #[Test]
    public function listActionWithAlphabeticalNavigationFlexFormShowsNavigationLinks(): void
    {
        $request = (new InternalRequest())->withPageId(5);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringContainsString('alphabetical-nav', $html);
    }

    #[Test]
    public function listActionWithoutAlphabeticalNavigationHidesNavigationLinks(): void
    {
        $request = (new InternalRequest())->withPageId(2);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringNotContainsString('alphabetical-nav', $html);
    }

    #[Test]
    public function listActionOnFirstPageShowsFirstPageOfAuthors(): void
    {
        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/listAction/ThreeAuthorsForPagination.csv'
        );

        $this->addTypoScriptToTemplateRecord(
            1,
            'plugin.tx_mdnewsauthor.settings.authorList.paginate.itemsPerPage = 2'
        );

        $request = (new InternalRequest())->withPageId(2);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringContainsString('Adams', $html);
        self::assertStringContainsString('Brown', $html);
        self::assertStringNotContainsString('Clark', $html);
    }

    #[Test]
    public function listActionOnSecondPageShowsRemainingAuthors(): void
    {
        $this->importCSVDataSet(
            __DIR__ . '/Fixtures/Database/NewsAuthorController/listAction/ThreeAuthorsForPagination.csv'
        );

        $this->addTypoScriptToTemplateRecord(
            1,
            'plugin.tx_mdnewsauthor.settings.authorList.paginate.itemsPerPage = 2'
        );

        $request = (new InternalRequest())->withPageId(2)->withQueryParameters([
            'tx_mdnewsauthor_list[currentPage]' => '2',
        ]);

        $html = (string)$this->executeFrontendSubRequest($request)->getBody();

        self::assertStringContainsString('Clark', $html);
        self::assertStringNotContainsString('Adams', $html);
        self::assertStringNotContainsString('Brown', $html);
    }
}
