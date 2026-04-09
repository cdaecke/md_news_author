<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Tests\Unit\ViewHelpers;

use Mediadreams\MdNewsAuthor\Domain\Model\NewsAuthor;
use Mediadreams\MdNewsAuthor\ViewHelpers\ShowAuthorNameViewHelper;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

#[CoversClass(ShowAuthorNameViewHelper::class)]
final class ShowAuthorNameViewHelperTest extends UnitTestCase
{
    private ShowAuthorNameViewHelper $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new ShowAuthorNameViewHelper();
    }

    private function setAuthorArgument(NewsAuthor $author): void
    {
        $property = new \ReflectionProperty(AbstractViewHelper::class, 'arguments');
        $property->setAccessible(true);
        $property->setValue($this->subject, ['author' => $author]);
    }

    #[Test]
    public function renderReturnsEmptyStringWhenAuthorIsNotAnObject(): void
    {
        $property = new \ReflectionProperty(AbstractViewHelper::class, 'arguments');
        $property->setAccessible(true);
        $property->setValue($this->subject, ['author' => null]);

        self::assertSame('', $this->subject->render());
    }

    #[Test]
    public function renderReturnsFirstAndLastname(): void
    {
        $author = new NewsAuthor();
        $author->setFirstname('John');
        $author->setLastname('Doe');
        $this->setAuthorArgument($author);

        self::assertSame('John Doe', $this->subject->render());
    }

    #[Test]
    public function renderIncludesTitleWhenSet(): void
    {
        $author = new NewsAuthor();
        $author->setTitle('Dr.');
        $author->setFirstname('John');
        $author->setLastname('Doe');
        $this->setAuthorArgument($author);

        self::assertSame('Dr. John Doe', $this->subject->render());
    }

    #[Test]
    public function renderFiltersEmptyParts(): void
    {
        $author = new NewsAuthor();
        $author->setFirstname('');
        $author->setLastname('Doe');
        $this->setAuthorArgument($author);

        self::assertSame('Doe', $this->subject->render());
    }

    #[Test]
    public function renderTrimsResult(): void
    {
        $author = new NewsAuthor();
        $author->setFirstname('John');
        $author->setLastname('Doe');
        $this->setAuthorArgument($author);

        self::assertSame('John Doe', $this->subject->render());
    }
}
