<?php

defined('TYPO3') or die('Access denied.');

/** @noinspection UnsupportedStringOffsetOperationsInspection */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['Webm'] =
    \Passionweb\Webm\Hooks\DataHandlerHook::class;
