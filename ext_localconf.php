<?php

defined('TYPO3') or die('Access denied.');

/** @noinspection UnsupportedStringOffsetOperationsInspection */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['Webm'] =
    \Passionweb\Webm\Hooks\DataHandlerHook::class;

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Passionweb\Webm\Task\WebmConverterTask::class] = array(
    'extension' => 'webm',
    'title' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.taskTitle',
    'description' => '',
);

