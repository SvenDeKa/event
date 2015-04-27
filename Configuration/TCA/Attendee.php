<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_z3event_domain_model_attendee'] = array(
	'ctrl' => $TCA['tx_z3event_domain_model_attendee']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, tx_extbase_type, fe_user, first_name, middle_name, last_name, name, salutation, title, company, position, type, telephone, fax, email, zip, city, country, www, dates, fe_owner,',
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, tx_extbase_type, first_name, middle_name, last_name, name, salutation, title, company, position, type, telephone, fax, email, address, zip, city, country, www, dates, fe_owner, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
		'Tx_Extbase_Domain_Model_FrontendUser' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, tx_extbase_type, salutation, fe_user, dates, fe_owner, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
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
				'foreign_table' => 'tx_z3event_domain_model_category',
				'foreign_table_where' => 'AND tx_z3event_domain_model_category.pid=###CURRENT_PID### AND tx_z3event_domain_model_category.sys_language_uid IN (-1,0)',
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
		
		'tx_extbase_type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.tx_extbase_type',
			'config' => array (
				'type' => 'select',
				'items' => array(
					array('Standalone', '0'),
					array('FeUser', '1'),
				)
			),
		),
		
		'salutation' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.salutation',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('Herr', 'm'),
					array('Frau', 'f'),
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
		'first_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'middle_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.middle_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'last_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.last_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.address',
			'config' => array(
				'type' => 'text',
			),
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.country',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
		'telephone' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.telephone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'fax' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.fax',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'www' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.www',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'company' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.company',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.type',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'position' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.position',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'fe_user' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.fe_user',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					''=>''
				)
			),
		),
		'fe_owner' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.fe_owner',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					''=>''
				)
			),
		),
		'dates' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_attendee.dates',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_z3event_domain_model_dateattendee',
				'foreign_field' => 'attendee',
				'foreign_label' => 'date',
				'foreign_selector' => 'date',
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
	),
);


?>