<?php
namespace TYPO3\Z3Event\Domain\Model;

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
class Date extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Anfang
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $datetimeStart;

	/**
	 * Ende
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $datetimeEnd;

	/**
	 * statustext
	 *
	 * @var string
	 */
	protected $statustext;
	
	/**
	 * status
	 *
	 * @var int
	 */
	protected $status;
	
	/**
	 * ganztägig
	 *
	 * @var boolean
	 */
	protected $daylong = FALSE;

	/**
	 * exclude
	 *
	 * @var boolean
	 */
	protected $exclude = FALSE;

	/**
	 * Veranstaltung
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Event
	 * @lazy
	 */
	protected $event;

	/**
	 * Veranstaltungsort
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Location
	 * @lazy
	 */
	protected $location;

	/**
	 * Veranstalter/ Referent / Speaker
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateHost>
	 * @lazy
	 */
	protected $hosts;

	/**
	 * Teilnehmer
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateAttendee>
	 * @lazy
	 */
	protected $attendees;

	/**
	 * Dokumente
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @lazy
	 */
	protected $media;

	/**
	 * __construct
	 *
	 * @return Date
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
//		$this->location = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	
		$this->hosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		
		$this->attendees = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		
		$this->media = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	
//		$this->event = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the datetimeStart
	 *
	 * @return \DateTime $datetimeStart
	 */
	public function getDatetimeStart() {
		return $this->datetimeStart;
	}

	/**
	 * Sets the datetimeStart
	 *
	 * @param \DateTime $datetimeStart
	 * @return void
	 */
	public function setDatetimeStart($datetimeStart) {
		$this->datetimeStart = $datetimeStart;
	}

	/**
	 * Returns the datetimeEnd
	 *
	 * @return \DateTime $datetimeEnd
	 */
	public function getDatetimeEnd() {
		return $this->datetimeEnd;
	}

	/**
	 * Sets the datetimeEnd
	 *
	 * @param \DateTime $datetimeEnd
	 * @return void
	 */
	public function setDatetimeEnd($datetimeEnd) {
		$this->datetimeEnd = $datetimeEnd;
	}

	/**
	 * Returns the daylong
	 *
	 * @return boolean $daylong
	 */
	public function getDaylong() {
		return $this->daylong;
	}

	/**
	 * Sets the daylong
	 *
	 * @param boolean $daylong
	 * @return void
	 */
	public function setDaylong($daylong) {
		$this->daylong = $daylong;
	}

	/**
	 * Returns the boolean state of daylong
	 *
	 * @return boolean
	 */
	public function isDaylong() {
		return $this->getDaylong();
	}
	
	/**
	 * Returns the status
	 *
	 * @return integer $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Sets the status
	 *
	 * @param integer $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}
	
	/**
	 * Returns the statustext
	 *
	 * @return integer $statustext
	 */
	public function getStatustext() {
		return $this->statustext;
	}

	/**
	 * Sets the statustext
	 *
	 * @param integer $statustext
	 * @return void
	 */
	public function setStatustext($statustext) {
		$this->statustext = $statustext;
	}

	/**
	 * Returns the exclude
	 *
	 * @return boolean $exclude
	 */
	public function getExclude() {
		return $this->exclude;
	}

	/**
	 * Sets the exclude
	 *
	 * @param boolean $exclude
	 * @return void
	 */
	public function setExclude($exclude) {
		$this->exclude = $exclude;
	}

	/**
	 * Returns the boolean state of exclude
	 *
	 * @return boolean
	 */
	public function isExclude() {
		return $this->getExclude();
	}

	/**
	 * Returns the event
	 *
	 * @return \TYPO3\Z3Event\Domain\Model\Event $event
	 */
	public function getEvent() {
		return $this->event;
	}

	/**
	 * Sets the event
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Event $event
	 * @return void
	 */
	public function setEvent(\TYPO3\Z3Event\Domain\Model\Event $event) {
		$this->event = $event;
	}

	/**
	 * Adds a Location
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Location $location
	 * @return void
	 */
	public function addLocation(\TYPO3\Z3Event\Domain\Model\Location $location) {
//		if($this->location === NULL){
//			$this->location = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
//		}
		$this->setLocation($location);
	}

	/**
	 * Removes a Location
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Location $locationToRemove The Location to be removed
	 * @return void
	 */
	public function removeLocation(\TYPO3\Z3Event\Domain\Model\Location $locationToRemove) {
//		if($this->location === NULL){
//			$this->location = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
//		}
		$this->location->detach($locationToRemove);
	}
	/**
	 * Returns the location
	 *
	 * @return \TYPO3\Z3Event\Domain\Model\Location $location
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the location
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Location $location
	 * @return void
	 */
	public function setLocation(\TYPO3\Z3Event\Domain\Model\Location $location) {
		$this->location = $location;
	}

	/**
	 * Adds a Host
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\DateHost $host
	 * @return void
	 */
	public function addHost(\TYPO3\Z3Event\Domain\Model\DateHost $host) {
		if($this->hosts === NULL){
			$this->hosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		}
		$this->hosts->attach($host);
	}

	/**
	 * Removes a Host
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\DateHost $hostToRemove The Host to be removed
	 * @return void
	 */
	public function removeHost(\TYPO3\Z3Event\Domain\Model\DateHost $hostToRemove) {
		$this->hosts->detach($hostToRemove);
	}

	/**
	 * Returns the hosts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateHost> $hosts
	 */
	public function getHosts() {
		return $this->hosts;
	}

	/**
	 * Sets the hosts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateHost> $hosts
	 * @return void
	 */
	public function setHosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $hosts) {
		$this->hosts = $hosts;
	}

	
	/**
	 * Adds a DateAttendee
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\DateAttendee $attendee
	 * @return void
	 */
	public function addAttendee(\TYPO3\Z3Event\Domain\Model\DateAttendee $attendee) {
		$this->attendees->attach($attendee);
	}

	/**
	 * Removes a DateAttendee
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\DateAttendee $attendeeToRemove The DateAttendee to be removed
	 * @return void
	 */
	public function removeAttendee(\TYPO3\Z3Event\Domain\Model\DateAttendee $attendeeToRemove) {
		$this->attendees->detach($attendeeToRemove);
	}

	/**
	 * Returns the attendees
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateAttendee> $attendees
	 */
	public function getAttendees() {
		
		$attendeeRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\Z3Event\Domain\Repository\DateAttendeeRepository');
		return $attendeeRepository->findByDate($this);
		
//		return $this->attendees;
	}

	/**
	 * Sets the attendees
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateAttendee> $attendees
	 * @return void
	 */
	public function setAttendees(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attendees) {
		$this->attendees = $attendees;
	}

//	/**
//	 * Adds a FileReference
//	 *
//	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $medium
//	 * @return void
//	 */
//	public function addMedium(\TYPO3\CMS\Extbase\Domain\Model\FileReference $medium) {
//		$this->media->attach($medium);
//	}
//
//	/**
//	 * Removes a FileReference
//	 *
//	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mediumToRemove The FileReference to be removed
//	 * @return void
//	 */
//	public function removeMedium(\TYPO3\CMS\Extbase\Domain\Model\FileReference $mediumToRemove) {
//		$this->media->detach($mediumToRemove);
//	}
//
//	/**
//	 * Returns the media
//	 *
//	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
//	 */
//	public function getMedia() {
//		return $this->media;
//	}
//
//	/**
//	 * Sets the media
//	 *
//	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
//	 * @return void
//	 */
//	public function setMedia(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $media) {
//		$this->media = $media;
//	}

}
?>