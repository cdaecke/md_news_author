<?php

declare(strict_types=1);

namespace Mediadreams\MdNewsAuthor\Updates;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2021 Christoph Daecke <typo3@mediadreams.org>
 *  This was kindly taken and adapted from ext:plain_faq (https://github.com/derhansen/plain_faq/)
 *  Thanks a lot to Torben Hansen!!!
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

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Class SwitchableControllerActionsPluginUpdater
 * @package Mediadreams\MdNewsAuthor\Updates
 */
class SwitchableControllerActionsPluginUpdater implements UpgradeWizardInterface
{
    private const MIGRATION_SETTINGS = [
        [
            'sourceListType' => 'mdnewsauthor_newsauthor',
            'switchableControllerActions' => 'NewsAuthor->list',
            'targetListType' => 'mdnewsauthor_list'
        ],
        [
            'sourceListType' => 'mdnewsauthor_newsauthor',
            'switchableControllerActions' => 'NewsAuthor->show',
            'targetListType' => 'mdnewsauthor_show'
        ],
    ];

    protected $flexFormService;

    public function __construct()
    {
        $this->flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
    }

    public function getIdentifier(): string
    {
        return 'switchableControllerActionsPluginUpdater';
    }

    public function getTitle(): string
    {
        return 'Migrates plugin and settings of existing EXT:md_news_author plugins using switchableControllerActions';
    }

    public function getDescription(): string
    {
        $description = 'The old News Author plugin using switchableControllerActions has been split into 2 separate plugins. ';
        $description .= 'This update wizard migrates all existing plugin settings and changes the Plugin (list_type) ';
        $description .= 'to use the new plugins available. This upgrade wizard is needed, if you upgrade ext:md_news_author ';
        $description .= 'from a version < 6.';
        return $description;
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class
        ];
    }

    public function updateNecessary(): bool
    {
        return $this->checkIfWizardIsRequired();
    }

    public function executeUpdate(): bool
    {
        return $this->performMigration();
    }

    public function checkIfWizardIsRequired(): bool
    {
        return count($this->getMigrationRecords()) > 0;
    }

    public function performMigration(): bool
    {
        $records = $this->getMigrationRecords();

        foreach ($records as $record) {
            $flexFormData = GeneralUtility::xml2array($record['pi_flexform']);
            $flexForm = $this->flexFormService->convertFlexFormContentToArray($record['pi_flexform']);
            $targetListType = $this->getTargetListType(
                $record['list_type'],
                $flexForm['switchableControllerActions']
            );
            $allowedSettings = $this->getAllowedSettingsFromFlexForm($targetListType);

            // Remove flexform data which do not exist in flexform of new plugin
            foreach ($flexFormData['data'] as $sheetKey => $sheetData) {
                foreach ($sheetData['lDEF'] as $settingName => $setting) {
                    if (!in_array($settingName, $allowedSettings, true)) {
                        unset($flexFormData['data'][$sheetKey]['lDEF'][$settingName]);
                    }
                }

                // Remove empty sheets
                if (!count($flexFormData['data'][$sheetKey]['lDEF']) > 0) {
                    unset($flexFormData['data'][$sheetKey]);
                }
            }

            if (count($flexFormData['data']) > 0) {
                $newFlexform = $this->array2xml($flexFormData);
            } else {
                $newFlexform = '';
            }

            $this->updateContentElement($record['uid'], $targetListType, $newFlexform);
        }

        return true;
    }

    protected function getMigrationRecords(): array
    {
        $checkListTypes = array_unique(array_column(self::MIGRATION_SETTINGS, 'sourceListType'));

        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('tt_content');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        return $queryBuilder
            ->select('uid', 'list_type', 'pi_flexform')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->in(
                    'list_type',
                    $queryBuilder->createNamedParameter($checkListTypes, Connection::PARAM_STR_ARRAY)
                )
            )
            ->execute()
            ->fetchAll();
    }

    protected function getTargetListType(string $sourceListType, string $switchableControllerActions): string
    {
        foreach (self::MIGRATION_SETTINGS as $setting) {
            if ($setting['sourceListType'] === $sourceListType &&
                $setting['switchableControllerActions'] === $switchableControllerActions
            ) {
                return $setting['targetListType'];
            }
        }

        return '';
    }

    protected function getAllowedSettingsFromFlexForm(string $listType): array
    {
        $flexFormFile = $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds'][$listType . ',list'];
        $flexFormContent = file_get_contents(GeneralUtility::getFileAbsFileName(substr(trim($flexFormFile), 5)));
        $flexFormData = GeneralUtility::xml2array($flexFormContent);

        // Iterate each sheet and extract all settings
        $settings = [];
        foreach ($flexFormData['sheets'] as $sheet) {
            foreach ($sheet['ROOT']['el'] as $setting => $tceForms) {
                $settings[] = $setting;
            }
        }

        return $settings;
    }

    /**
     * Updates list_type and pi_flexform of the given content element UID
     *
     * @param int $uid
     * @param string $newListType
     * @param string $flexform
     */
    protected function updateContentElement(int $uid, string $newListType, string $flexform): void
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $queryBuilder->update('tt_content')
            ->set('list_type', $newListType)
            ->set('pi_flexform', $flexform)
            ->where(
                $queryBuilder->expr()->in(
                    'uid',
                    $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)
                )
            )
            ->execute();
    }

    /**
     * Transforms the given array to FlexForm XML
     *
     * @param array $input
     * @return string
     */
    protected function array2xml(array $input = []): string
    {
        $options = [
            'parentTagMap' => [
                'data' => 'sheet',
                'sheet' => 'language',
                'language' => 'field',
                'el' => 'field',
                'field' => 'value',
                'field:el' => 'el',
                'el:_IS_NUM' => 'section',
                'section' => 'itemType'
            ],
            'disableTypeAttrib' => 2
        ];
        $spaceInd = 4;
        $output = GeneralUtility::array2xml($input, '', 0, 'T3FlexForms', $spaceInd, $options);
        $output = '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>' . LF . $output;
        return $output;
    }
}
