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
class AttendeeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	
	/**
	 * eventRepository
	 *
	 * @var \TYPO3\Z3Event\Domain\Repository\DateRepository
	 * @inject
	 */
	protected $dateRepository;
	
	/**
	 * eventRepository
	 *
	 * @var \TYPO3\Z3Event\Domain\Repository\DateAttendeeRepository
	 * @inject
	 */
	protected $dateAttendeeRepository;
	
	/**
	 * eventRepository
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
	public function listOwnedAction() {
		$attendees = $this->attendeeRepository->findByFeOwner($feuser);
		$this->view->assign('attendees', $attendees);
	}
	
	/**
	 * action list
	 * 
	 * @param \TYPO3\Z3Event\Domain\Model\Attendee $attendee
	 * 
	 * @return void
	 */
	public function editAction(\TYPO3\Z3Event\Domain\Model\Attendee $attendee){
		$this->view->assign('attendee', $attendee);
		
	}
	
	/**
	 * action new
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Attendee $newAttendee
	 * @dontvalidate $newAttendee
	 * @return void
	 */
	public function newAction(\TYPO3\Z3Event\Domain\Model\Attendee $newAttendee = NULL) {
		if ($newAttendee == NULL) { // workaround for fluid bug ##5636
			$newAttendee = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Domain\Model\Attendee');
		}
		$this->view->assign('newAttendee', $newAttendee);
	}

	/**
	 * action create
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Attendee $newAttendee
	 * @return void
	 */
	public function createAction(\TYPO3\Z3Event\Domain\Model\Attendee $newAttendee) {
		$this->attendeeRepository->add($newAttendee);
		$this->flashMessageContainer->add('new Attendee was created.');
		$this->redirect('new');
	}
	
	/**
	 * action list
	 * 
	 * @param \TYPO3\Z3Event\Domain\Model\Attendee $attendee
	 * @param \TYPO3\Z3Event\Domain\Model\Date $date
	 * 
	 * @return void
	 */
	public function removeFromDateAction(\TYPO3\Z3Event\Domain\Model\Attendee $attendee, \TYPO3\Z3Event\Domain\Model\Date $date) {
		$attendee->getDates();
	}
	
	/**
	 * action list
	 * 
	 * @param \TYPO3\Z3Event\Domain\Model\Attendee $attendee
	 * @param \TYPO3\Z3Event\Domain\Model\Date $date
	 * 
	 * @return void
	 */
	public function addToDateAction(\TYPO3\Z3Event\Domain\Model\Attendee $newAttendee, \TYPO3\Z3Event\Domain\Model\Date $date, $reminder, $status) {
		$this->attendeeRepository->add($newAttendee);
		$this->persistenceManager->persistAll();
		
		$newDateAttendee = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Domain\Model\DateAttendee');
		$newDateAttendee->setStatus($status);
		$newDateAttendee->setAttendee($newAttendee);
		$newDateAttendee->setDate($date);
		
		$this->dateAttendeeRepository->add($newDateAttendee);
		$this->persistenceManager->persistAll();
		
		$this->dateRepository->attachAttendees($newDateAttendee);
		$this->persistenceManager->persistAll();
		
	}

}
?>