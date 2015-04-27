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
class EventController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$events = $this->eventRepository->findAll();
		$this->view->assign('events', $events);
	}
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function highlightAction() {
		if($this->settings['eventHighlight']['highlights'] !== ''){
			$events = $this->eventRepository->findFutureEventsByUids($this->settings['eventHighlight']['highlights'],$this->settings['eventHighlight']['showPast'], 50);
		}
		
		if( $this->settings['limit'] > 0 && count($events) > $this->settings['limit']){
			$orderedEvents = $this->objectToArray($events);
			$events = array();
			$i = 0;
			while($this->settings['limit'] > $i){
				$index = rand(0, count($orderedEvents) - 1);
				if( $orderedEvents[$index]!== NULL && count($orderedEvents[$index]->getFutureDates() ) > 0){
					$events[] = $orderedEvents[$index];
				}
				unset($orderedEvents[$index]);
				$orderedEvents = array_values($orderedEvents);
				if($i < count($events)){
					$i = count($events);
				}else{
					$i = $this->settings['limit'];
//					\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($i.' vs count(events): '.count($events),'stop! this seems to go nowhere!');
				}
			}
		}
		$this->view->assign('events', $events);
	}

	/**
	 * action show
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Event $event
	 * @return void
	 */
	public function showAction(\TYPO3\Z3Event\Domain\Model\Event $event) {
		$this->view->assign('event', $event);
	}
	
	
	
	/**
	 * action list for JSON-output
	 *
	 * @return void
	 */
	public function jsonListByNameSubstringAction() {
		$events = $this->eventRepository->findByNameSubstring('uid,name', $this->request->getArgument('q'), TRUE);
		return json_encode($events);
	}
	
	/**
	 * convert the object to array
	 */
	public function objectToArray($object) {
		$array = array();
		foreach($object as $i => $v){
			$array[] = $v;
		}
		return $array;
	}

}
?>