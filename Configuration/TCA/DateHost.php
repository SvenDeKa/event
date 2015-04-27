<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_z3event_domain_model_datehost'] = array(
	'ctrl' => $TCA['tx_z3event_domain_model_datehost']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, status, host,',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, status, host,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_z3event_domain_model_datehost',
				'foreign_table_where' => 'AND tx_z3event_domain_model_datehost.pid=###CURRENT_PID### AND tx_z3event_domain_model_datehost.sys_language_uid IN (-1,0)',
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
		'status' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_datehost.status',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('angefragt', 'requested'),
					array('bestätigt', 'confirmed'),
					array('verfügbar', 'available'),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		
		'date' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		
		'host' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_datehost.host',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_z3event_domain_model_host',
//				'foreign_field' => 'dates',
				'allowed' => 'tx_z3event_domain_model_host',
				'minitems' => 0,
				'maxitems' => 10,
			),
		),
		
		
	),
);

?>