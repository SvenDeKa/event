<?php
namespace TYPO3\Z3Event\Hooks;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Sven Külpmann <sven.kuelpmann@lenz-wie-fruehling.de>, Ziegelei3
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package z3_event
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class EventWizicon {

	const KEY = 'z3_event';

	/**
	 * Processing the wizard items array
	 *
	 * @param array $wizardItems The wizard items
	 * @return array array with wizard items
	 */
	public function proc($wizardItems) {
		$wizardItems['plugins_tx_' . self::KEY. '_events'] = array(
			'icon'			=> \t3lib_extMgm::extRelPath(self::KEY) . 'Resources/Public/Icons/ce_wiz.gif',
			'title'			=> $GLOBALS['LANG']->sL('LLL:EXT:z3_event/Resources/Private/Language/locallang_be.xml:events_title'),
			'description'	=> $GLOBALS['LANG']->sL('LLL:EXT:z3_event/Resources/Private/Language/locallang_be.xml:events_description'),
			'params'		=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=z3event_events'
		);
		$wizardItems['plugins_tx_' . self::KEY. '_hosts'] = array(
			'icon'			=> \t3lib_extMgm::extRelPath(self::KEY) . 'Resources/Public/Icons/ce_wiz.gif',
			'title'			=> $GLOBALS['LANG']->sL('LLL:EXT:z3_event/Resources/Private/Language/locallang_be.xml:hosts_title'),
			'description'	=> $GLOBALS['LANG']->sL('LLL:EXT:z3_event/Resources/Private/Language/locallang_be.xml:hosts_description'),
			'params'		=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=z3event_hosts'
		);
		$wizardItems['plugins_tx_' . self::KEY. '_locations'] = array(
			'icon'			=> \t3lib_extMgm::extRelPath(self::KEY) . 'Resources/Public/Icons/ce_wiz.gif',
			'title'			=> $GLOBALS['LANG']->sL('LLL:EXT:z3_event/Resources/Private/Language/locallang_be.xml:locations_title'),
			'description'	=> $GLOBALS['LANG']->sL('LLL:EXT:z3_event/Resources/Private/Language/locallang_be.xml:locations_description'),
			'params'		=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=z3event_events'
		);

		return $wizardItems;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/z3_event/Classes/Hooks/BeWizard.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/z3_event/Classes/Hooks/BeWizard.php']);
}

?>