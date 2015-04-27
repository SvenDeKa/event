<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_z3event_domain_model_event'] = array(
	'ctrl' => $TCA['tx_z3event_domain_model_event']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, subtitle, description, categories, tags, dates, media',
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, subtitle, description, categories, tags, dates, media,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_z3event_domain_model_event',
				'foreign_table_where' => 'AND tx_z3event_domain_model_event.pid=###CURRENT_PID### AND tx_z3event_domain_model_event.sys_language_uid IN (-1,0)',
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
		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_event.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_event.subtitle',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_event.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_event.categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_z3event_domain_model_category',
				'allowed' => 'tx_z3event_domain_model_category',
//				'foreign_field' => 'events',
				'minitems' => 0,
				'size'=>5,
				'maxitems' => 99,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest'
					),
				),
			),
		),
		'tags' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_event.tags',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'dates' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_event.dates',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_z3event_domain_model_date',
				'foreign_field' => 'event',
				'foreign_sortby' => 'datetime_start',
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
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_event.media',
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