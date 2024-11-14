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
                    [
                    'label' => '',
                    'value' => 0,
                    ]
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
                        'label' => 0,
                        'value' => '',
                    ],
                    [
                        'label' => 1,
                        'value' => '',
                    ],
                    [
                        'label' => 'invertStateDisplay',
                        'value' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
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
                'type' => 'datetime',
                'format' => 'date',
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
                'type' => 'number',
                'size' => 30,
                'default' => 0
            ],
        ],
        'sys_file_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.sys_file_uid',
            'config' => [
                'type' => 'number',
                'size' => 30,
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
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_zero',
                        'value' => 0,
                    ],
                    [
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_one',
                        'value' => 1,
                    ],
                    [
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_two',
                        'value' => 2,
                    ],
                    [
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_three',
                        'value' => 3,
                    ],
                    [
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_four',
                        'value' => 4,
                    ],
                    [
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_five',
                        'value' => 5,
                    ],
                    [
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_six',
                        'value' => 6,
                    ],
                    [
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_seven',
                        'value' => 7,
                    ],
                    [
                        'label' => 'LLL:EXT:webm/Resources/Private/Language/locallang_db.xlf:tx_webm_domain_model_queueitem.status_eight',
                        'value' => 8,
                    ],
                ],
            ],
        ],
    ],
];
