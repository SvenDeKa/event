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
class T3libBefunc{

	
	/**
	* Which fields to be removed in which View
	* @var array
	*/
	public $removedFieldsInDateList = array(
		'sDEF' => 'dateList.pid,limit,eventHighlight.showPast,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	public $removedFieldsInDateShow = array(
		'sDEF' => 'dateShow.pid,limit,eventHighlight.showPast,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	public $removedFieldsInDateCalendar = array(
		'sDEF' => 'limit,eventHighlight.showPast,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	public $removedFieldsInDateUpcoming = array(
		'sDEF' => 'switchViews.showSwitchToCal,eventHighlight.showPast,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	
	public $removedFieldsInEventList = array(
		'sDEF' => 'dateList.pid,eventHighlight.showPast,limit,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	public $removedFieldsInEventShow = array(
		'sDEF' => 'switchViews.showSwitchToCal,eventHighlight.showPast,limit,dateList.pid,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	public $removedFieldsInEventHightlight = array(
		'sDEF' => 'switchViews.showSwitchToCal,dateList.pid,dateShow.pid,'
	);
	
	
	public $removedFieldsInHostList = array(
		'sDEF' => 'hosts.pidList,switchViews.showSwitchToCal,dateList.pid,eventHighlight.showPast,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	public $removedFieldsInHostShow = array(
		'sDEF' => 'hosts.pidShow,switchViews.showSwitchToCal,dateList.pid,eventHighlight.showPast,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	public $removedFieldsInLocationList = array(
		'sDEF' => 'locations.pidList,switchViews.showSwitchToCal,dateList.pid,eventHighlight.showPast,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	public $removedFieldsInLocationShow = array(
		'sDEF' => 'locations.pidShow,switchViews.showSwitchToCal,dateList.pid,eventHighlight.showPast,eventShow.pid,eventHighlight.randomIfMore,eventHighlight.highlights'
	);
	/**
	* Hook function of t3lib_befunc
	*
	* @param array &$dataStructure Flexform structure
	* @param array $conf some strange configuration
	* @param array $row row of current record
	* @param string $table table anme
	* @param string $fieldName some strange field name
	* @return void
	*/
	public function getFlexFormDS_postProcessDS(&$dataStructure, $conf, $row, $table, $fieldName) {
		if ($table === 'tt_content' && $row['list_type'] === 'z3event_events' && is_array($dataStructure)) {
			$this->updateFlexforms($dataStructure, $row, 'events');
		}
		if ($table === 'tt_content' && $row['list_type'] === 'z3event_hosts' && is_array($dataStructure)) {
			$this->updateFlexforms($dataStructure, $row, 'hosts');
		}
		if ($table === 'tt_content' && $row['list_type'] === 'z3event_locations' && is_array($dataStructure)) {
			$this->updateFlexforms($dataStructure, $row, 'locations');
		}
	}

	/**
	* Update flexform configuration if a action is selected
	*
	* @param array|string &$dataStructure flexform structur
	* @param array $row row of current record
	* @param string $plugin plugin of current flexform
	* @return void
	*/
	protected function updateFlexforms(array &$dataStructure, array $row, $plugin=NULL) {
		$selectedView = '';

		// get the first selected action
		$flexformSelection = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($row['pi_flexform']);
		if (is_array($flexformSelection) && is_array($flexformSelection['data'])) {
			$selectedView = $flexformSelection['data']['sDEF']['lDEF']['switchableControllerActions']['vDEF'];
			if (!empty($selectedView)) {
				$actionParts = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(';', $selectedView, TRUE);
				$selectedView = $actionParts[0];
			}

		// new plugin element
		} elseif(\TYPO3\CMS\Core\Utility\GeneralUtility::isFirstPartOfStr($row['uid'], 'NEW') && $plugin=='events') {
			// use List as starting view
			$selectedView = 'Event->list';
		} elseif(\TYPO3\CMS\Core\Utility\GeneralUtility::isFirstPartOfStr($row['uid'], 'NEW') && $plugin=='hosts') {
			$selectedView = 'Host->list';
		} elseif(\TYPO3\CMS\Core\Utility\GeneralUtility::isFirstPartOfStr($row['uid'], 'NEW') && $plugin=='locations') {
			$selectedView = 'Location->list';
		}
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($selectedView, '$selectedView');

		if (!empty($selectedView)) {
			// modify the flexform structure depending on the first found action
			switch ($selectedView) {
				case 'Date->list':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInDateList);
					break;
				case 'Date->calendar':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInDateCalendar);
					break;
				case 'Date->show':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInDateShow);
					break;
				case 'Date->upcoming':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInDateUpcoming);
					break;
				case 'Event->list':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInEventList);
					break;
				case 'Event->show':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInEventShow);
					break;
				case 'Event->highlight':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInEventHightlight);
					break;
				case 'Host->list':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInHostList);
					break;
				case 'Host->show':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInHostShow);
					break;
				case 'Location->list':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInLocationList);
					break;
				case 'Location->show':
					$this->deleteFromStructure($dataStructure, $this->removedFieldsInLocationShow);
					break;
				default:
					$this->deleteFromStructure($dataStructure, $this->removedFieldsIneList);
					break;
			}
		}
	}

	/**
	* Remove fields from flexform structure
	*
	* @param array &$dataStructure flexform structure
	* @param array $fieldsToBeRemoved fields which need to be removed
	* @return void
	*/
	private function deleteFromStructure(array &$dataStructure, array $fieldsToBeRemoved) {
		foreach ($fieldsToBeRemoved as $sheetName => $sheetFields) {
			$fieldsInSheet = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $sheetFields, TRUE);

			foreach ($fieldsInSheet as $fieldName) {
				unset($dataStructure['sheets'][$sheetName]['ROOT']['el']['settings.' . $fieldName]);
			}
		}
	}


}
?>
