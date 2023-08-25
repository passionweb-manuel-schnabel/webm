<?php

declare(strict_types=1);

namespace Passionweb\Webm\Service;

use FFMpeg\Exception\RuntimeException;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use Passionweb\Webm\Domain\Model\QueueItem;
use Passionweb\Webm\Domain\Repository\QueueItemRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use function explode;


class WebmConverterService
{
    protected const BYTES = 1024 * 1024;

    protected LoggerInterface $logger;

    protected FlashMessageService $flashMessageService;

    protected ResourceFactory $resourceFactory;

    protected ExtensionConfiguration $extensionConfiguration;

    protected QueueItemRepository $queueItemRepository;

    protected PersistenceManager $persistenceManager;

    protected array $extConf = [];

    /**
     * @throws ExtensionConfigurationPathDoesNotExistException
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     */
    public function __construct(
        LoggerInterface         $logger,
        FlashMessageService     $flashMessageService,
        ResourceFactory         $resourceFactory,
        ExtensionConfiguration  $extensionConfiguration,
        QueueItemRepository     $queueItemRepository,
        PersistenceManager      $persistenceManager
    )
    {
        $this->logger = $logger;
        $this->flashMessageService = $flashMessageService;
        $this->resourceFactory = $resourceFactory;
        $this->extensionConfiguration = $extensionConfiguration;
        $this->queueItemRepository = $queueItemRepository;
        $this->persistenceManager = $persistenceManager;

        $this->extConf = $this->extensionConfiguration->get('webm');
    }

    /**
     * @return false|string[]
     */
    public function getSupportedMimeTypes()
    {
        return explode(',', $this->extConf['mimeTypes']);
    }

    /**
     * @return bool
     */
    public function convertOnSave(): bool
    {
        return $this->extConf['convertOnSave'] === '1';
    }

    /**
     * @param int $uid
     * @return File
     * @throws FileDoesNotExistException
     */
    public function getVideoFileByUid(int $uid)
    {
        return $this->resourceFactory->getFileObject($uid);
    }

    /**
     * @param File $originalVideoFile
     * @return File|null
     */
    public function getWebMFileByCombinedIdentifier(File $originalVideoFile): ?File
    {
        return $this->resourceFactory->getFileObjectFromCombinedIdentifier($this->getCombinedFilePathWebM($originalVideoFile));
    }

    /**
     * @param File $originalVideoFile
     * @return string
     */
    public function getAbsoluteFileStoragePath(File $originalVideoFile): string
    {
        return Environment::getPublicPath() . '/' . substr($originalVideoFile->getStorage()->getConfiguration()['basePath'], 0, -1);
    }

    /**
     * @param File $originalVideoFile
     * @return string
     */
    public function getCombinedFilePathWebM(File $originalVideoFile): string
    {
        return str_replace($originalVideoFile->getExtension(), 'webm', $originalVideoFile->getCombinedIdentifier());
    }

    /**
     * @param File $originalVideoFile
     * @return string
     */
    public function getFileIdentifierWebM(File $originalVideoFile): string
    {
        return str_replace($originalVideoFile->getExtension(), 'webm', $originalVideoFile->getIdentifier());
    }

    /**
     * @param File $originalVideoFile
     * @return string
     */
    public function getAbsoluteFilePathWebM(File $originalVideoFile): string
    {
        return $this->getAbsoluteFileStoragePath($originalVideoFile) . $this->getFileIdentifierWebM($originalVideoFile);
    }

    /**
     * @param File $originalVideoFile
     * @return File|null
     */
    public function convertVideoToWebM(File $originalVideoFile): ?File
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($this->getAbsoluteFileStoragePath($originalVideoFile) . $originalVideoFile->getIdentifier());
        $video->save(new WebM(), $this->getAbsoluteFilePathWebM($originalVideoFile));
        return $this->resourceFactory->getFileObjectFromCombinedIdentifier($this->getCombinedFilePathWebM($originalVideoFile));
    }

    /**
     * @param File $originalVideoFile
     * @param array $datamap
     * @param string $newId
     * @return void
     * @throws IllegalObjectTypeException
     */
    public function addVideoToQueue(File $originalVideoFile, array $datamap, string $newId, array $substNEWwithIDs)
    {
        $tablenames = array_key_first($datamap);
        $fieldname = '';

        if(count($substNEWwithIDs) > 0) {
            $newRecordId = array_key_first($substNEWwithIDs);
            $uidForeign = $substNEWwithIDs[$newRecordId];
        } else {
            $uidForeign = (int) array_key_first($datamap[$tablenames]);
            $newRecordId = $uidForeign;
        }

        foreach($datamap[$tablenames][$newRecordId] as $key => $value) {
            if(!empty($value) && !is_array($value)) {
                $parts = explode(",", $value);
                if(in_array($newId, $parts)) {
                    $fieldname = $key;
                    break;
                }
            }
        }
        if(!empty($fieldname)) {
            $newQueueItem = new QueueItem();
            $newQueueItem->setPid((int) $this->extConf['storagePid']);
            $newQueueItem->setFieldname($fieldname);
            $newQueueItem->setTablenames($tablenames);
            $newQueueItem->setUidForeign($uidForeign);
            $newQueueItem->setSysFileUid($originalVideoFile->getUid());

            $this->queueItemRepository->add($newQueueItem);
            $this->persistenceManager->persistAll();
        }
    }

    /**
     * @param array $fieldArray
     * @param DataHandler $pObj
     * @param string $newId
     * @return void
     */
    public function handleVideoConvertion(array &$fieldArray, DataHandler $pObj, string $newId) {
        try {
            $file = $this->getVideoFileByUid((int) $fieldArray['uid_local']);

            /**
             * file is a video and has not the mime type video/webm
             */
            if(!empty($file) && $file->getMimeType() !== 'video/webm' && in_array($file->getMimeType(), $this->getSupportedMimeTypes())) {

                /**
                 * wrap detection of webm file with a try-catch block to handle InvalidArgumentException
                 */
                try {
                    $fileWebM = $this->getWebMFileByCombinedIdentifier($file);
                } catch(\InvalidArgumentException $exception) {
                    $fileWebM = null;
                }

                /**
                 * file with mime type video/webm does not exist or file does not exist in file system --> create video with mime type video/webm or add it to queue
                 */
                if(empty($fileWebM) || !file_exists($this->getAbsoluteFilePathWebM($file))) {
                    if($this->convertOnSave()) {
                        $fileWebM = $this->convertVideoToWebM($file);
                        /**
                         * set uid of new created webm sys file for storing sys_file_reference in content element
                         */
                        $fieldArray['uid_local'] = $fileWebM->getUid();
                        $this->addFlashMessage('', LocalizationUtility::translate('LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.convertionSuccessful', 'webm'), FlashMessage::OK);

                    } else {
                        $this->addVideoToQueue($file, $pObj->datamap, $newId, $pObj->substNEWwithIDs);
                        $this->addFlashMessage('', LocalizationUtility::translate('LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.addVideoToQueueSuccessful', 'webm'), FlashMessage::OK);
                    }
                }
            }
        } catch (FileDoesNotExistException $e) {
            $this->logger->error($e->getMessage(), ['sys_file_uid' => $fieldArray['uid_local']]);
            $this->addFlashMessage('', LocalizationUtility::translate('LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.originalVideoNotFound', 'webm'), FlashMessage::ERROR);
        } catch (IllegalObjectTypeException $e) {
            $this->logger->error($e->getMessage());
            $this->addFlashMessage('', LocalizationUtility::translate('LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.videoNotAddedToQueue', 'webm'), FlashMessage::ERROR);
        } catch (RuntimeException $e) {
            $this->logger->error($e->getMessage());
            $this->addFlashMessage('', LocalizationUtility::translate('LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.errorConvertingVideo', 'webm'), FlashMessage::ERROR);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            $this->addFlashMessage('', LocalizationUtility::translate('LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.unexpectedError', 'webm'), FlashMessage::ERROR);
        }
    }

    /**
     * @return void
     * @throws FileDoesNotExistException
     */
    public function processVideoQueue() {
        $queueItems = $this->queueItemRepository->findByStatus(0);

        /** @var QueueItem $queueItem */
        foreach ($queueItems as $queueItem) {
            try {
                $processVideo = true;
                $file = $this->getVideoFileByUid($queueItem->getSysFileUid());
                if(empty($file)) {
                    $processVideo = false;
                    $this->updateQueueItem($queueItem, 1);
                }
                if($processVideo && !in_array($file->getMimeType(), $this->getSupportedMimeTypes())) {
                    $processVideo = false;
                    $this->updateQueueItem($queueItem, 2);
                }
                if($processVideo && $this->extConf['maxVideoFileSize'] > 0 && $file->getSize() > $this->extConf['maxVideoFileSize'] * self::BYTES) {
                    $processVideo = false;
                    $this->updateQueueItem($queueItem, 3);
                }
                if($processVideo) {
                    $fileWebM = $this->convertVideoToWebM($file);
                    $this->updateSysFileReference($fileWebM->getUid(), $queueItem);
                    $this->updateQueueItem($queueItem, 4);
                }
            } catch (FileDoesNotExistException $e) {
                $this->logger->error($e->getMessage(), ['sys_file_uid' => $queueItem->getSysFileUid()]);
                $this->updateQueueItem($queueItem, 5);
                throw $e;
            } catch (RuntimeException $e) {
                $this->logger->error($e->getMessage());
                $this->updateQueueItem($queueItem, 7);
                throw $e;
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->updateQueueItem($queueItem, 8);
                throw $e;
            }
        }
    }

    /**
     * @param QueueItem $queueItem
     * @param int $status
     * @return void
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    private function updateQueueItem($queueItem, $status) {
        // hide and update current queue item in any case
        $queueItem->setStatus($status);
        $queueItem->setHidden(1);
        $this->queueItemRepository->update($queueItem);
        $this->persistenceManager->persistAll();
    }

    /**
     * @param int $fileWebMUid
     * @param QueueItem $queueItem
     * @return void
     */
    private function updateSysFileReference($fileWebMUid, $queueItem) {
        /** @var FileRepository $fileRepository */
        $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
        $fileObjects = $fileRepository->findByRelation($queueItem->getTablenames(), $queueItem->getFieldname(), $queueItem->getUidForeign());

        $data = [];
        /**
         * loop through relations and check if current original video is in use
         * add the relevant date to data array
         */
        foreach ($fileObjects as $fileObject) {
            if($fileObject->getOriginalFile()->getUid() === $queueItem->getSysFileUid()) {
                $data['sys_file_reference'][$fileObject->getUid()] = [
                    'uid_local' => $fileWebMUid
                ];
            }
        }

        /**
         * initalize backend user for command line interface and DataHandler
         * update the relevant sys_file_references
         */
        Bootstrap::initializeBackendAuthentication();
        $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $dataHandler->start($data, []);
        $dataHandler->process_datamap();

        if ($dataHandler->errorLog !== []) {
            foreach ($dataHandler->errorLog as $log) {
                $this->logger->error($log);
            }
        }
        $dataHandler->clear_cacheCmd('all');
    }

    /**
     * @param string $messageText
     * @param string $messageHeader
     * @param string $severity
     * @return void
     */
    private function addFlashMessage($messageText, $messageHeader, $severity) {
        $message = GeneralUtility::makeInstance(FlashMessage::class,
            $messageText,
            $messageHeader,
            $severity,
            true
        );
        $messageQueue = $this->flashMessageService->getMessageQueueByIdentifier();
        $messageQueue->addMessage($message);
    }
}
