<?php
namespace TYPO3\Z3Event\Utility;

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
class Calendar {
	
	/**
	 * dateRepository
	 *
	 * @var \TYPO3\Z3Event\Domain\Repository\DateRepository
	 * @inject
	 */
	protected $dateRepository;
	
	/**
	 * 
	 * @param type $start
	 * @param type $mode
	 * @return type
	 */
	public function buildCalendar($start, $mode='month', $filters = NULL, $order=NULL){
		if($mode=='week'){
			$calendar = $this->buildWeekCalendar($start, $filters, $order);
		}else{
			$calendar = $this->buildMonthCalendar($start, $filters, $order);
		}
		return $calendar;
	}
	
	/**
	 * 
	 * @param string $start
	 * @return array
	 */
	public function buildMonthCalendar($startDate = NULL, $filters = NULL, $order=NULL){
		$this->loadSettings();
		
		// Startdatum setzen
		if($startDate === NULL){
			$startDate = new \DateTime();
		}
		$startDate->modify('first day of this month');
		$startDate->modify('midnight');
		
		// Start für Kalenderanzeige bestimmen
		$preDate = clone($startDate);
		if($startDate->format("N") > 1) {
			$preDate->modify('last monday of previous month');
		}
		
		// Ende des Monats bestimmen
		$stopDate = clone($startDate);
		$stopDate->modify('last day of this month');
		$stopDate->modify('+86399 seconds');
		$postDate = clone($stopDate);
		if($stopDate->format("N") < 7) {
			$postDate->modify('next sunday');
		}

		// Navigational dates
		$shownMonth = clone($startDate);
		$shownMonth->modify('first day of this month');
		$currentMonth =  new \DateTime('first day of this month');
		$nextMonth = $this->getNextMonth($startDate);
		$previousMonth = $this->getPreviousMonth($startDate);
		
		$today = new \DateTime('today');
		$today->modify('midnight');
		
		$days = array();
		$runDate = clone($preDate);
		
		while($runDate <= $postDate) {
			$this->dateRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Domain\Repository\DateRepository');
		
			$dayStart = clone($runDate);
			$dayEnd = clone($runDate);
			$dayEnd->modify('+86399 seconds');
			
			// dates 
			if($this->settings['calendar']['showPastEvents'] == 0 && $today->format('U') > $dayStart->format('U')){
				$dates = NULL;
			}else{
				$dates = $this->dateRepository->findAllBetween($dayStart, $dayEnd, $filters, $order);
			}
			if($this->settings['calendar']['dontLinkPastEvents'] == 1 && $today->format('U') > $dayStart->format('U')){
				$dontLinkDates = 1;
			}else{
				$dontLinkDates = 0;
			}
			$days[$runDate->format("Y-m-d")] = array(
				'datetime' => $dayStart, 
				'dates' => $dates,
				'isShownMonth' => ($dayStart->format('U') >= $shownMonth->format('U') && $nextMonth->format('U') > $dayStart->format('U')),
				'isPrevMonth' => ($shownMonth->format('U') > $dayStart->format('U')),
				'isNextMonth' => ($dayStart->format('U') > $nextMonth->format('U')),
				'isWeekend' => ($dayStart->format('D')=='Sat' || $dayStart->format('D')=='Sun'),
				'isToday' => ($dayStart->format('U') == $today->format('U')),
				'isPast' => ($today->format('U') > $dayStart->format('U')),
				'isFuture' => ($today->format('U') < $dayStart->format('U')),
				'dontLinkDates' => $dontLinkDates,
				);
			$runDate->modify('tomorrow');
		}
		
		// Year-Navigation
		$nextYear = $this->getNextYear($startDate);
		$previousYear = $this->getPreviousYear($startDate);

		$weeks = array();
		for($i = 0; $i < floor(count($days)/7); $i++) {
			$weeks[] = array_slice($days, $i*7, 7, TRUE);
		}

		$calendar = array(
			'month' => $weeks,
			'navigation' => array(
				'shownMonth' => $shownMonth,
				'shownYear' => $this->getShownYear($startDate),
				'currentMonth' => $currentMonth,
				'nextMonth' => $nextMonth,
				'previousMonth' => $previousMonth,
				'nextYear' => $nextYear,
				'previousYear' => $previousYear,
			),
		);
		
		return $calendar;
	}
	
	/**
	 * 
	 * @param string $start
	 * @return array
	 */
	public function buildWeekCalendar($startDate = NULL, $filters = NULL, $order=NULL){
		
		$this->loadSettings();
		
		// Startdatum setzen
		if($startDate === NULL){
			$startDate = new \DateTime();
			$startDate->modify('this week');
		}
		$startDate->modify('midnight');
		
		// Start für Kalenderanzeige bestimmen
//		$preDate = clone($startDate);
//		if($startDate->format("N") !== 1) {
//			$preDate->modify('previous week');
//		}
		
		// Ende der Woche
		$stopDate = clone($startDate);
		$stopDate->modify('+6 days');
//		$stopDate->modify('+86399 seconds');


		// Navigational dates
		$shownWeek = clone($startDate);
		$shownWeek->modify('this week');
		$currentWeek =  new \DateTime('this week');
		$currentWeek->modify('midnight');
		$nextWeek = clone($startDate);
		$nextWeek->modify('next week');
		$previousWeek = clone($startDate);
		$previousWeek->modify('previous week');
		
		$today = new \DateTime('today');
		$today->modify('midnight');
		
		if($this->settings['calendar']['showPastWeeks'] != 1){
			if($currentWeek->format('U') > $previousWeek->format('U') ) $previousWeek = NULL;
		}
		
		$days = array();
		$runDate = clone($startDate);
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($startDate,'$startDate');
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($stopDate,'$stopDate');
		while($runDate <= $stopDate) {
			$this->dateRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Domain\Repository\DateRepository');
		
			$dayStart = clone($runDate);
			$dayEnd = clone($runDate);
			$dayEnd->modify('+86399 seconds');
			
			// dates 
			if($this->settings['calendar']['showPastEvents'] == 0 && $today->format('U') > $dayStart->format('U')){
				$dates = NULL;
			}else{
				$dates = $this->dateRepository->findAllBetween($dayStart, $dayEnd, $filters, $order);
			}
			if($this->settings['calendar']['dontLinkPastEvents'] == 1 && $today->format('U') > $dayStart->format('U')){
				$dontLinkDates = 1;
			}else{
				$dontLinkDates = 0;
			}
			$days[$runDate->format("Y-m-d")] = array(
				'datetime' => $dayStart, 
				'dates' => $dates,
				'isShownWeek' => ($dayStart->format('U') >= $shownWeek->format('U') && $nextWeek->format('U') > $dayStart->format('U')),
				'isWeekend' => ($dayStart->format('D')=='Sat' || $dayStart->format('D')=='Sun'),
				'isToday' => ($dayStart->format('U') == $today->format('U')),
				'isPast' => ($today->format('U') > $dayStart->format('U')),
				'isFuture' => ($today->format('U') < $dayStart->format('U')),
				'dontLinkDates' => $dontLinkDates,
				);
			$runDate->modify('tomorrow');
		}
		
		// Year-Navigation
//		$nextYear = $this->getNextYear($startDate);
//		$previousYear = $this->getPreviousYear($startDate);

//		$weeks = array();
//		for($i = 0; $i < floor(count($days)/7); $i++) {
//			$weeks[] = array_slice($days, $i*7, 7, TRUE);
//		}
		$lastDay = clone($shownWeek);
		$lastDay->modify('+6 days');
		
		$calendar = array(
			'week' => $days,
			'navigation' => array(
				'shownWeek' => $shownWeek,
//				'shownYear' => $this->getShownYear($startDate),
				'currentWeek' => $currentWeek,
				'nextWeek' => $nextWeek,
				'previousWeek' => $previousWeek,
				'firstDay' => $shownWeek,
				'lastDay' => $lastDay,
			),
		);
		return $calendar;
	}
	
	
	private function getShownYear($startDate){
		
		$nextYear = $this->getNextYear($startDate);
		$shownYear = clone($startDate);
		$shownYear->modify('first day of January this year');
		$runDate = clone($shownYear);
		$currentMonth = new \DateTime;
		$currentMonth->modify('first day of this month')->modify('midnight');
		$i=0;
		while($runDate < $nextYear){
			$current = clone($runDate);
			$months[$i]['dateTime'] = $current;
			$months[$i]['isShownMonth'] = ($current == $startDate);
			$months[$i]['isPast'] = ($current < $currentMonth);
			$months[$i]['isFuture'] = ($current > $currentMonth);
			$months[$i]['isCurrentMonth'] = ($current == $currentMonth);
			$runDate->modify('first day of next month');
			$i++;
		}
		return array(
			'dateTime' => $shownYear,
			'months' => $months,
		);
	}
	
	private function getCurrentYear(){
		$currentYear =  new \DateTime('first day of January this year');
		$currentYear->modify('midnight');
		return $currentYear;
	}
	
	/**
	 * get the next Year
	 * 
	 */
	private function getNextYear($startDate){
		$nextYear = clone($startDate);
		$nextYear->modify('first day of January next year')->modify('midnight');
		return $nextYear;
	}
	
	/**
	 * get the previous Year
	 * 
	 */
	private function getPreviousYear($startDate){
		
		$previousYear = clone($startDate);
		$previousYear->modify('first day of January previous year')->modify('midnight');
		
		$currentYear = $this->getCurrentYear();
		if($this->settings['calendar']['showPastMonths'] != 1){
			if($currentYear->format('U') >= $previousYear->format('U') ) $previousYear = NULL;
		}
		return $previousYear;
	}
	
	/**
	 * get the next Month
	 * 
	 */
	private function getNextMonth($startDate){
		$nextMonth = clone($startDate);
		$nextMonth->modify('first day of next month');
		return $nextMonth;
	}
	
	/**
	 * get the previous Month
	 * 
	 */
	private function getPreviousMonth($startDate){
		
		$previousMonth = clone($startDate);
		$previousMonth->modify('first day of previous month');
		
		$currentMonth =  new \DateTime('first day of this month');
		$currentMonth->modify('midnight');
		
		if($this->settings['calendar']['showPastMonths'] != 1){
			if($currentMonth->format('U') > $previousMonth->format('U') ) $previousMonth = NULL;
		}
		return $previousMonth;
	}
	
	
	/**
	 * Load the TS-Settings
	 * 
	 */
	private function loadSettings(){
		
		// get settings
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$configurationManager = $objectManager->get('TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface');
		$this->settings = $configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Z3Event', 'Events'
		);
		
	}
}

?>
