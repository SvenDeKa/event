<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_z3event_domain_model_date'] = array(
	'ctrl' => $TCA['tx_z3event_domain_model_date']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, datetime_start, datetime_end, status, statustext, daylong, exclude, event, location, hosts, attendees, media',
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, datetime_start, datetime_end, status, statustext, daylong, exclude, event, location, hosts, attendees, media,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'0' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_z3event_domain_model_date',
				'foreign_table_where' => 'AND tx_z3event_domain_model_date.pid=###CURRENT_PID### AND tx_z3event_domain_model_date.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'datetime_start' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.datetime_start',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'datetime_end' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.datetime_end',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'daylong' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.daylong',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		
		'status' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.status',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.status.open', 0),
					array('LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.status.closed', -1),
					array('LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.status.new', 1),
					array('LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.status.shortSupply', 2),
				),
			)
		),
		'statustext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.statustext',
			'config' => array(
				'type' => 'input',
				'size' => 10,
			)
		),
		'exclude' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.exclude',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
//		'event' => array(
//			'config' => array(
//				'type' => 'passthrough',
//			),
//		),
		'event' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.event',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_z3event_domain_model_event',
//				'foreign_field' => 'dates',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'location' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.location',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_z3event_domain_model_location',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					array('', ''),
				),
			),
		),
		
		'hosts' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.hosts',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_z3event_domain_model_datehost',
				'foreign_field' => 'date',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		
		
		'attendees' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.attendees',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_z3event_domain_model_dateattendee',
				'foreign_field' => 'date',
//				'foreign_label' => 'attendee',
//				'foreign_selector' => 'attendee',
				'minitems'      => 0,
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		
		
		'media' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_date.media',
			'config' => array(
				'maxitems' => 100,
				'type' => 'inline',
				'foreign_table' => 'sys_file_reference',
				'foreign_field' => 'uid_foreign',
				'foreign_sortby' => 'sorting',
				'foreign_table_field' => 'tablenames',
				'foreign_match_fields' => array(
					'fieldname' => 'media'
				),
				'foreign_label' => 'uid_local',
				'foreign_selector' => 'uid_local',
				'foreign_selector_fieldTcaOverride' => array(
					'config' => array(
						'appearance' => array(
							'elementBrowserType' => 'file',
							'elementBrowserAllowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
						)
					)
				),
				'filter' => array(
					array(
						'userFunc' => 'TYPO3\\CMS\\Core\\Resource\\Filter\\FileExtensionFilter->filterInlineChildren',
						'parameters' => array(
							'allowedFileExtensions' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
							'disallowedFileExtensions' => ''
						)
					)
				),
				'appearance' => array(
                     'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
                     'collapseAll' => TRUE,
				)
			)
		),
	),
);

?>