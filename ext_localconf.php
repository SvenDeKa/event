<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TYPO3_CONF_VARS['FE']['eID_include']['z3event'] = 'EXT:z3_event/Classes/Utility/AjaxDispatcher.php';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Events',
	array(
		'Event' => 'list, show',
		'Date' => 'list, show, calendar',
		'Attendee' => 'list',
		'DateAttendee' => 'create, edit'
	),
	// non-cacheable actions
	array(
		'Event' => 'show',
		'Date' => 'calendar, addDateAttendee, show',
		'Attendee' => '',
		'DateAttendee' => 'create, edit'
	)
);


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Hosts',
	array(
		'Host' => 'list, show',
	),
	// non-cacheable actions
	array(
		'Host' => 'show',
	)
);


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Locations',
	array(
		'Location' => 'list, show',
	),
	// non-cacheable actions
	array(
		'Location' => 'show',
	)
);


// Switchable-ControllerAction-onChange
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_befunc.php']['getFlexFormDSClass'][$_EXTKEY] =
 'EXT:' . $_EXTKEY. '/Classes/Hooks/T3libBefunc.php:TYPO3\Z3Event\Hooks\T3libBefunc';

?>