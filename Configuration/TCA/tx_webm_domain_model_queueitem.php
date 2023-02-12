<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem',
        'label' => 'sys_file_uid',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'status,tablenames,fieldname,sys_file_uid',
        'iconfile' => 'EXT:webm/Resources/Public/Icons/tx_webm_domain_model_queueitem.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'status,tablenames,fieldname,uid_foreign,sys_file_uid, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden,'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_webm_domain_model_queueitem',
                'foreign_table_where' => 'AND {#tx_webm_domain_model_queueitem}.{#pid}=###CURRENT_PID### AND {#tx_webm_domain_model_queueitem}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'tablenames' => [
            'exclude' => true,
            'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.tablenames',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'fieldname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.fieldname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'uid_foreign' => [
            'exclude' => true,
            'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.uid_foreign',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int',
                'default' => 0
            ],
        ],
        'sys_file_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.sys_file_uid',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int',
                'default' => 0
            ],
        ],
        'status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_zero',
                        0,
                    ],
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_one',
                        1,
                    ],
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_two',
                        2,
                    ],
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_three',
                        3,
                    ],
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_four',
                        4,
                    ],
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_five',
                        5,
                    ],
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_six',
                        6,
                    ],
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_seven',
                        7,
                    ],
                    [
                        'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_eight',
                        8,
                    ],
                ],
            ],
        ],
    ],
];
