<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\AbstractListTypeToCTypeUpdate;

/**
 * Migrates existing tt_content records from list_type=mdnewsauthor_list / mdnewsauthor_show
 * to the new CType=mdnewsauthor_list / mdnewsauthor_show
 */
#[UpgradeWizard('mdNewsAuthorPluginListTypeToCTypeUpdate')]
final class ExtbasePluginListTypeToCTypeUpdate extends AbstractListTypeToCTypeUpdate
{
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'mdnewsauthor_list' => 'mdnewsauthor_list',
            'mdnewsauthor_show' => 'mdnewsauthor_show',
        ];
    }

    public function getTitle(): string
    {
        return 'EXT:md_news_author: Migrate plugin list_type to CType';
    }

    public function getDescription(): string
    {
        return 'Migrates existing tt_content records using list_type "mdnewsauthor_list" or "mdnewsauthor_show" to the new CType-based plugin registration.';
    }
}
