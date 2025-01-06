<?php

declare(strict_types=1);

namespace Passionweb\Webm\Hooks;

use Passionweb\Webm\Service\WebmConverterService;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DataHandlerHook
{
    private const TABLE = 'sys_file_reference';

    public function processDatamap_postProcessFieldArray(string $status, string $table, $id, array &$fieldArray, DataHandler $pObj): void
    {
        if ($table === self::TABLE && $status === 'new') {
            $webMService = GeneralUtility::makeInstance(WebmConverterService::class);
            $webMService->handleVideoConversion($fieldArray, $pObj, $id);
        }
    }
}
