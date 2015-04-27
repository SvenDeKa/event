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
class DateHost extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * zugesagt, frei, angefragt
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $status = '';


	/**
	 * Veranstalter, Speaker, o.ä
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Host
	 */
	protected $host = NULL;
	
	/**
	 * date
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Date
	 */
	protected $date = NULL;
	
	
	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 * 
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->host = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->date = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}
	
	
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
	 * Returns the host
	 *
	 * @return \TYPO3\Z3Event\Domain\Model\Host $host
	 */
	public function getHost() {
		return $this->host;
	}

	/**
	 * Sets the host
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Host $host
	 * @return void
	 */
	public function setHost(\TYPO3\Z3Event\Domain\Model\Host $host) {
		$this->host = $host;
	}

	/**
	 * Adds a (Date-)Host
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Host $host
	 * @return void
	 */
	public function addHost(\TYPO3\Z3Event\Domain\Model\Host $host) {
		$this->host->attach($host);
	}

	/**
	 * Removes a (Date-)Host
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Host $hostToRemove The DateHost to be removed
	 * @return void
	 */
	public function removeHost(\TYPO3\Z3Event\Domain\Model\Host $hostToRemove) {
		$this->host->detach($hostToRemove);
	}

}
?>