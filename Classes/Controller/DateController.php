<?php
namespace TYPO3\Z3Event\Controller;

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
class DateController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * locationRepository
	 *
	 * @var \TYPO3\Z3Event\Domain\Repository\LocationRepository
	 * @inject
	 */
	protected $locationRepository;
	
	/**
	 * eventRepository
	 *
	 * @var \TYPO3\Z3Event\Domain\Repository\EventRepository
	 * @inject
	 */
	protected $eventRepository;
	
	/**
	 * dateRepository
	 *
	 * @var \TYPO3\Z3Event\Domain\Repository\DateRepository
	 * @inject
	 */
	protected $dateRepository;
	
	/**
	 * dateAttendeeRepository
	 *
	 * @var \TYPO3\Z3Event\Domain\Repository\DateAttendeeRepository
	 * @inject
	 */
	protected $dateAttendeeRepository;
	
	/**
	 * attendeeRepository
	 *
	 * @var \TYPO3\Z3Event\Domain\Repository\AttendeeRepository
	 * @inject
	 */
	protected $attendeeRepository;
	
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		
		$cityRepository = $this->objectManager->get('\TYPO3\Z3Event\Domain\Repository\CityRepository');
		$blankCities = array(0 => new \TYPO3\Z3Event\Domain\Model\City);
		$cities = array_merge($blankCities, $cityRepository->findAll());
		
		
		$filters = NULL;
		$sorting = array(
			'sortBy' => 'datetimeStart',
			'ordering' => 'ASC'
		);
		if($this->request->hasArgument('filters')){
			
			if($this->request->hasArgument('sorting')){
				$sorting = $this->request->getArgument('sorting');
			}
			$filters = $this->request->getArgument('filters');
			
		}
		
		$dates = $this->dateRepository->findAllFiltered($filters, $sorting, NULL, $this->settings['calendar']['showPastEvents']);
		
		
		
		$mode = 'list';
		if( $this->request->hasArgument('mode')){
			if($mode === 'list' || $mode === 'tiles' ){
				$mode = $this->request->getArgument('mode');
			}
		}
		
		$this->view->assign('filters', $filters);
		$this->view->assign('sorting', $sorting);
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($dates,'$dates');
		$this->view->assign('dates', $dates);
		$this->view->assign('cities', $cities);
		$this->view->assign('mode', $mode);
		
		
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Utility\Assets');
		$assets->addAssets($this->settings);
	}
	
	
	/**
	 * upcoming list
	 *
	 * @return void
	 */
	public function upcomingAction() {
		
		$limit = NULL;
		if($this->settings['limit'] > 0){
			$limit = $this->settings['limit'];
		}
		
		$dates = $this->dateRepository->findAllFiltered(NULL, NULL,  $limit, 0);
		
		
		
		$mode = 'list';
		if( $this->request->hasArgument('mode')){
			if($mode === 'list' || $mode === 'tiles' ){
				$mode = $this->request->getArgument('mode');
			}
		}
		
		$this->view->assign('filters', $filters);
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($dates,'$dates');
		$this->view->assign('dates', $dates);
	}

	/**
	 * action calendar
	 *
	 * @return void
	 */
	public function calendarAction() {
		
		$cityRepository = $this->objectManager->get('\TYPO3\Z3Event\Domain\Repository\CityRepository');
		$blankCities = array(0 => new \TYPO3\Z3Event\Domain\Model\City);
		$cities = array_merge($blankCities, $cityRepository->findAll());

		$startDate = NULL;
		// wenn kein Datums-parameter mitgegeben, dann heute als start
		$dateArguments = array();
		if($this->request->hasArgument('year')){
			$startDate = new \DateTime();
			$dateArguments['year'] = $this->request->getArgument('year');
			$week = 1;
			$month = 1;
			$day = 1;
			if($this->request->hasArgument('week')){
				$dateArguments['week'] = $this->request->getArgument('week');
				$week = $dateArguments['week'];
				$startDate->setISODate($dateArguments['year'],$week);
			}
			if($this->request->hasArgument('month')){
				$dateArguments['month'] = $this->request->getArgument('month');
				$month = $dateArguments['month'];
				if($this->request->hasArgument('day')){
					$dateArguments['day'] = $this->request->getArgument('day');
					$day = $dateArguments['day'];
				}
				$startDate->setDate($dateArguments['year'],$month,$day);
			}
		}
		
		
		
		$mode = 'month';
		if( $this->request->hasArgument('mode')){
			if($mode === 'week' || $mode === 'month' ){
				$mode = $this->request->getArgument('mode');
			}
		}
		
		
		if($this->request->hasArgument('filters')){
			$order=NULL;
			
			if($this->request->hasArgument('order')){
				$order = $this->request->getArgument('order');
			}
			$filters = $this->request->getArgument('filters');
			
		}
		
		// Calendar-utility instanzieren
		$cal = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Utility\Calendar');
		$calendar = $cal->buildCalendar($startDate, $mode, $filters, $order);
		
		$this->view->assign('mode', $mode);
		$this->view->assign('dateArguments', $dateArguments);
		$this->view->assign('calendar', $calendar);
		$this->view->assign('filters', $filters);
		$this->view->assign('cities', $cities);
		
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Utility\Assets');
		$assets->addAssets($this->settings);
	}

	/**
	 * action show
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Date $date
	 * @return void
	 */
	public function showAction(\TYPO3\Z3Event\Domain\Model\Date $date) {
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings , 'date->showAction');
		$this->view->assign('date', $date);
		
		//	load Assets
		$assets = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Utility\Assets');
		$assets->addAssets($this->settings);
	}

}
?>