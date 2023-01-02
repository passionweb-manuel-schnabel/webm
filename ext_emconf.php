<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Creates WebM copies of videos',
    'description' => 'Creates WebM copies of videos',
    'category' => 'fe',
    'author' => 'Manuel Schnabel',
    'author_email' => 'service@passionweb.de',
    'author_company' => 'PassionWeb Manuel Schnabel',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => ['typo3' => '11.5.0-11.5.99'],
        'conflicts' => [],
        'suggests' => [],
    ],
];
