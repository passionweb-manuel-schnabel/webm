<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Creates WebM copies of videos',
    'description' => 'Creates a WebM file for every configured (and supported) video format. Either via Symfony command or hook (can be configured).',
    'category' => 'misc',
    'author' => 'Manuel Schnabel',
    'author_email' => 'service@passionweb.de',
    'author_company' => 'PassionWeb Manuel Schnabel',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '2.0.0',
    'constraints' => [
        'depends' => ['typo3' => '12.0.0-12.4.99'],
        'conflicts' => [],
        'suggests' => [],
    ],
];
