<?php

/*
 * Custom bootstrap for functional tests.
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

    $testbase = new \TYPO3\TestingFramework\Core\Testbase();
    $testbase->defineOriginalRootPath();
    $testbase->createDirectory(ORIGINAL_ROOT . 'typo3temp/var/tests');
    $testbase->createDirectory(ORIGINAL_ROOT . 'typo3temp/var/transient');
})();
