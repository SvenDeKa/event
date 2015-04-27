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
class DateAttendee extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * zugesagt, frei, angefragt
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $status;
	
	/**
	 * möchte Reminder
	 *
	 * @var \boolean
	 */
	protected $reminder;

	/**
	 * Termin
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Date
	 */
	protected $date;

	/**
	 * Teilnehmer
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Attendee
	 */
	protected $attendee;

	/**
	 * Returns the status
	 *
	 * @return \integer $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Sets the status
	 *
	 * @param \integer $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}
	
	/**
	 * Returns the reminder
	 *
	 * @return \boolean $reminder
	 */
	public function getReminder() {
		return $this->reminder;
	}

	/**
	 * Sets the reminder
	 *
	 * @param \boolean $reminder
	 * @return void
	 */
	public function setReminder($remidner) {
		$this->reminder = $reminder;
	}

	/**
	 * Returns the date
	 *
	 * @return \TYPO3\Z3Event\Domain\Model\Date $date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Sets the date
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Date $date
	 * @return void
	 */
	public function setDate(\TYPO3\Z3Event\Domain\Model\Date $date) {
		$this->date = $date;
	}

	/**
	 * Returns the attendee
	 *
	 * @return \TYPO3\Z3Event\Domain\Model\Attendee $attendee
	 */
	public function getAttendee() {
		return $this->attendee;
	}

	/**
	 * Sets the attendee
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Attendee $attendee
	 * @return void
	 */
	public function setAttendee(\TYPO3\Z3Event\Domain\Model\Attendee $attendee) {
		$this->attendee = $attendee;
	}

	/**
	 * Adds a (Date-)Attendee
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\DateAttendee $attendee
	 * @return void
	 */
	public function addAttendee(\TYPO3\Z3Event\Domain\Model\DateAttendee $attendee) {
		$this->dates->attach($attendee);
	}

	/**
	 * Removes a (Date-)Attendee
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\DateAttendee $attendeeToRemove The DateAttendee to be removed
	 * @return void
	 */
	public function removeAttendee(\TYPO3\Z3Event\Domain\Model\DateAttendee $attendeeToRemove) {
		$this->dates->detach($attendeeToRemove);
	}
}
?>