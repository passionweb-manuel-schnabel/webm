<?php

$EM_CONF['webm'] = [
    'title' => 'WebM copies of videos',
    'description' => 'Creates a WebM file for every configured (and supported) video format. Either via Symfony command or hook (can be configured).',
    'category' => 'misc',
    'author' => 'Manuel Schnabel',
    'author_email' => 'service@passionweb.de',
    'author_company' => 'PassionWeb Manuel Schnabel',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '4.0.0',
    'constraints' => [
        'depends' => ['typo3' => '14.0.0-14.3.99'],
        'conflicts' => [],
        'suggests' => [],
    ],
];
