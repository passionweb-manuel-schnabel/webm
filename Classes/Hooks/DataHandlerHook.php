<?php
declare(strict_types = 1);


namespace Passionweb\Webm\Hooks;


use Passionweb\Webm\Service\WebmConverterService;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class DataHandlerHook
 */
class DataHandlerHook
{
    private const TABLE = 'sys_file_reference';

    /**
     * @param string $status
     * @param string $table
     * @param string|int $id
     * @param array $fieldArray
     * @param DataHandler $pObj
     *
     */
    public function processDatamap_postProcessFieldArray(string $status, string $table, $id, array &$fieldArray, DataHandler $pObj): void
    {
        if ($table === self::TABLE && $status === 'new') {
            /** @var WebmConverterService $webMService */
            $webMService = GeneralUtility::makeInstance(WebmConverterService::class);
            $webMService->handleVideoConvertion($fieldArray, $pObj, $id);
        }
    }
}
