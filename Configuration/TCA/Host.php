<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_z3event_domain_model_host'] = array(
	'ctrl' => $TCA['tx_z3event_domain_model_host']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, salutation, title, name, company, position, city, email, www, vita, images, dates',
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, salutation, title, name, company, position, city, email, www, vita, images, dates --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	//	'Tx_Extbase_Domain_Model_FrontendUser' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, tx_extbase_type, salutation, fe_user, dates, fe_owner, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
		
		'salutation' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.salutation',
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
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),		
		
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
		'company' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.company',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'position' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.position',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
		'www' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.www',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'images' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.images',
			'config' => array(
				'maxitems' => 1,
				'type' => 'inline',
				'foreign_table' => 'sys_file_reference',
				'foreign_field' => 'uid_foreign',
				'foreign_sortby' => 'sorting_foreign',
				'foreign_table_field' => 'tablenames',
				'foreign_match_fields' => array(
					'fieldname' => 'images'
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
			),
		),
		
		'vita' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.vita',
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
		
		'dates' => array(
			'exclude' => 0,
			'config' => array(
				'type' => 'passthrough',
				)
			)
		),
//		'dates' => array(
//			'exclude' => 1,
//			'label' => 'LLL:EXT:z3_event/Resources/Private/Language/locallang_db.xlf:tx_z3event_domain_model_host.dates',
//			'config' => array(
//				'type' => 'inline',
//				'foreign_table' => 'tx_z3event_domain_model_datehost',
//				'foreign_field' => 'host',
//				'foreign_selector' => 'date',
//				'foreign_label' => 'date',
//				'maxitems'      => 9999,
//				
//				'appearance' => array(
//					'collapseAll' => 0,
//					'levelLinksPosition' => 'top',
//					'showSynchronizationLink' => 1,
//					'showPossibleLocalizationRecords' => 1,
//					'showAllLocalizationLink' => 1,
//					'useCombination' => 1,
//				),
//			),
//		),
//	),
);


?>