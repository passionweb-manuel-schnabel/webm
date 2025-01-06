<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'WebM copies of videos',
    'description' => 'Creates a WebM file for every configured (and supported) video format. Either via Symfony command or hook (can be configured).',
    'category' => 'misc',
    'author' => 'Manuel Schnabel',
    'author_email' => 'service@passionweb.de',
    'author_company' => 'PassionWeb Manuel Schnabel',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '3.0.0',
    'constraints' => [
        'depends' => ['typo3' => '13.0.0-13.4.99'],
        'conflicts' => [],
        'suggests' => [],
    ],
];
