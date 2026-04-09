<?php

use TYPO3\TestingFramework\Core\Testbase;
use TYPO3\CMS\Core\Http\Application;
use TYPO3\TestingFramework\Core\SystemEnvironmentBuilder;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\Cache\Frontend\PhpFrontend;
use TYPO3\CMS\Core\Cache\Backend\NullBackend;
use TYPO3\CMS\Core\Package\UnitTestPackageManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Package\PackageManager;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/*
 * Custom bootstrap for unit tests.
 *
 * If TYPO3_PATH_ROOT is not set by the caller, this bootstrap tries to
 * resolve it by walking up from the vendor directory until a directory
 * containing an index.php is found. This supports both standalone
 * development (e.g. inside a DDEV project) and CI environments where
 * the extension is installed as part of a full TYPO3 project.
 */
(static function (): void {
    if (!getenv('TYPO3_PATH_ROOT')) {
        // Walk up from <ext>/.Build/vendor to find the TYPO3 web root
        $candidates = [
            // When installed as a path repo in a TYPO3 project:
            // <project>/packages/<ext>/.Build/vendor → <project>/public
            dirname(__DIR__, 4) . '/public',
            // When installed directly in vendor/:
            // <project>/vendor/<vendor>/<ext>/.Build/vendor → <project>/public
            dirname(__DIR__, 6) . '/public',
        ];

        foreach ($candidates as $candidate) {
            if (file_exists($candidate . '/index.php')) {
                putenv('TYPO3_PATH_ROOT=' . $candidate);
                $_ENV['TYPO3_PATH_ROOT'] = $candidate;
                break;
            }
        }
    }

    // Set composer mode explicitly since autoload-include.php is not loaded automatically
    // in the extension's isolated .Build/vendor setup.
    if (!defined('TYPO3_COMPOSER_MODE')) {
        define('TYPO3_COMPOSER_MODE', true);
    }

    $testbase = new Testbase();

    if (!getenv('TYPO3_PATH_WEB')) {
        putenv('TYPO3_PATH_WEB=' . rtrim($testbase->getWebRoot(), '/'));
    }

    $testbase->defineSitePath();

    $composerMode = defined('TYPO3_COMPOSER_MODE') && TYPO3_COMPOSER_MODE === true;

    $hasConsolidatedHttpEntryPoint = class_exists(Application::class);
    if ($hasConsolidatedHttpEntryPoint) {
        SystemEnvironmentBuilder::run(0, \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::REQUESTTYPE_CLI, $composerMode);
    } else {
        $requestType = \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::REQUESTTYPE_BE | \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::REQUESTTYPE_CLI;
        SystemEnvironmentBuilder::run(0, $requestType, $composerMode);
    }

    $testbase->createDirectory(Environment::getPublicPath() . '/typo3conf/ext');
    $testbase->createDirectory(Environment::getPublicPath() . '/typo3temp/assets');
    $testbase->createDirectory(Environment::getPublicPath() . '/typo3temp/var/tests');
    $testbase->createDirectory(Environment::getPublicPath() . '/typo3temp/var/transient');

    $classLoader = require $testbase->getPackagesPath() . '/autoload.php';
    Bootstrap::initializeClassLoader($classLoader);

    $configurationManager = new ConfigurationManager();
    $GLOBALS['TYPO3_CONF_VARS'] = $configurationManager->getDefaultConfiguration();

    $cache = new PhpFrontend(
        'core',
        new NullBackend('production', [])
    );
    $packageManager = Bootstrap::createPackageManager(
        UnitTestPackageManager::class,
        Bootstrap::createPackageCache($cache)
    );

    GeneralUtility::setSingletonInstance(PackageManager::class, $packageManager);
    ExtensionManagementUtility::setPackageManager($packageManager);

    $testbase->dumpClassLoadingInformation();

    GeneralUtility::purgeInstances();
})();
