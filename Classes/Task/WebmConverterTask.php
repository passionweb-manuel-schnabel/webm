<?php
namespace Passionweb\Webm\Task;

use Passionweb\Webm\Service\WebmConverterService;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

class WebmConverterTask extends AbstractTask
{
    public function execute() {
        try {
            $webMConverterService = GeneralUtility::makeInstance(WebmConverterService::class);
            $webMConverterService->processVideoQueue();
            return true;
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            return false;
        }
    }
}
