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
//class Attendee extends \Tx_Extbase_Domain_Model_FrontendUser {
class Attendee extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	
	/**
	 * FrontendUser
	 *
	 * @var \Tx_Extbase_Domain_Model_FrontendUser
	 * @lazy
	 */
	protected $feUser;
	
	/**
	 * FrontendUser owning the attendee
	 *
	 * @var \Tx_Extbase_Domain_Model_FrontendUser
	 * @lazy
	 */
	protected $feOwner;
	
	
	/**
	 * Salutation
	 * 
	 * @var \string
	 */
	protected $salutation;
	
	/**
	 * Title
	 * 
	 * @var \string
	 */
	protected $title;
	
	
	/**
	 * Firstname
	 * 
	 * @var \string
	 */
	protected $firstName;
	
	/**
	 * middlename
	 * 
	 * @var \string
	 */
	protected $middleName;
	
	/**
	 * Name
	 * 
	 * @var \string
	 */
	protected $name;
			
	/**
	 * Address
	 * 
	 * @var \string
	 */
	protected $address;
			
	/**
	 * telephone
	 * 
	 * @var \string
	 */
	protected $telephone;
			
	/**
	 * fax
	 * 
	 * @var \string
	 */
	protected $fax;
			
	/**
	 * email
	 * 
	 * @var \string
	 */
	protected $email;
			
			
	/**
	 * zip
	 * 
	 * @var \string
	 */
	protected $zip;
			
	/**
	 * city
	 * 
	 * @var \string
	 */
	protected $city;
			
	/**
	 * country
	 * 
	 * @var \string
	 */
	protected $country;
			
	/**
	 * www
	 * 
	 * @var \string
	 */
	protected $www;
	
	/**
	 * company
	 * 
	 * @var \string
	 */
	protected $company;
			
	
	//ToDo: IMAGE/images
	
	
	/**
	 * Termine
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateAttendee>
	 * @lazy
	 */
	protected $dates;
	
	/**
	 * position
	 * 
	 * @var \string
	 */
	protected $position;
	
	/**
	 * type
	 * 
	 * @var \string
	 */
	protected $type;

	/**
	 * __construct
	 *
	 * @return Attendee
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
		$this->dates = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a DateAttendee
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\DateAttendee $date
	 * @return void
	 */
	public function addDate(\TYPO3\Z3Event\Domain\Model\DateAttendee $date) {
		$this->dates->attach($date);
	}

	/**
	 * Removes a DateAttendee
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\DateAttendee $dateToRemove The DateAttendee to be removed
	 * @return void
	 */
	public function removeDate(\TYPO3\Z3Event\Domain\Model\DateAttendee $dateToRemove) {
		$this->dates->detach($dateToRemove);
	}

	/**
	 * Returns the dates
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateAttendee> $dates
	 */
	public function getDates() {
		return $this->dates;
	}

	/**
	 * Sets the dates
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\DateAttendee> $dates
	 * @return void
	 */
	public function setDates(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dates) {
		$this->dates = $dates;
	}


	/**
	 * Returns the fe-User
	 *
	 * @return \Tx_Extbase_Domain_Model_FrontendUser $feUser
	 */
	public function getFeUser() {
		return $this->feUser;
	}

	/**
	 * Sets the dates
	 *
	 * @param \Tx_Extbase_Domain_Model_FrontendUser $feUser
	 * @return void
	 */
	public function setFeUser(\Tx_Extbase_Domain_Model_FrontendUser $feUser) {
		$this->feUser = $feUser;
	}

	/**
	 * Returns the fe-Owner
	 *
	 * @return \Tx_Extbase_Domain_Model_FrontendUser $feOwner
	 */
	public function getFeOwner() {
		return $this->feOwner;
	}

	/**
	 * Sets the dates
	 *
	 * @param \Tx_Extbase_Domain_Model_FrontendUser $feOwner
	 * @return void
	 */
	public function setFeOwner(\Tx_Extbase_Domain_Model_FrontendUser $feOwner) {
		$this->feOwner = $feOwner;
	}
	
	
	/**
	 * Returns the salutation
	 *
	 * @return \string $salutation
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * Sets the salutation
	 *
	 * @param \string $salutation
	 * @return void
	 */
	public function setSalutation($salutation) {
		$this->salutation = $salutation;
	}
	
	
	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	
	/**
	 * Returns the firstName
	 *
	 * @return \string $firstName
	 */
	public function getFirstName() {
//		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('firstname from DefaultModel','');
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param \string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	
	
	/**
	 * Returns the middleName
	 *
	 * @return \string $middleName
	 */
	public function getMiddleName() {
		return $this->middleName;
	}

	/**
	 * Sets the middleName
	 *
	 * @param \string $middleName
	 * @return void
	 */
	public function setMiddleName($middleName) {
		$this->middleName = $middleName;
	}
	
	
	/**
	 * Returns the lastName
	 *
	 * @return \string $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the lastName
	 *
	 * @param \string $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	
	
	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	
	/**
	 * Returns the address
	 *
	 * @return \string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param \string $address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}
	
	
	/**
	 * Returns the telephone
	 *
	 * @return \string $telephone
	 */
	public function getTelephone() {
		return $this->telephone;
	}

	/**
	 * Sets the telephone
	 *
	 * @param \string $telephone
	 * @return void
	 */
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}
	
	
	/**
	 * Returns the fax
	 *
	 * @return \string $fax
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the fax
	 *
	 * @param \string $fax
	 * @return void
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}
	
	
	/**
	 * Returns the email
	 *
	 * @return \string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param \string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	
	/**
	 * Returns the zip
	 *
	 * @return \string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param \string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}
	
	
	/**
	 * Returns the city
	 *
	 * @return \string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param \string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}
	
	
	/**
	 * Returns the country
	 *
	 * @return \string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}
	
	
	/**
	 * Returns the www
	 *
	 * @return \string $www
	 */
	public function getWww() {
		return $this->www;
	}

	/**
	 * Sets the www
	 *
	 * @param \string $www
	 * @return void
	 */
	public function setWww($www) {
		$this->www = $www;
	}
	
	
	/**
	 * Returns the company
	 *
	 * @return \string $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Sets the company
	 *
	 * @param \string $company
	 * @return void
	 */
	public function setCompany($company) {
		$this->company = $company;
	}
	
	
	/**
	 * Returns the position
	 *
	 * @return \string $position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Sets the position
	 *
	 * @param \string $position
	 * @return void
	 */
	public function setPosition($position) {
		$this->position = $position;
	}
	
	
	/**
	 * Returns the type
	 *
	 * @return \string $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param \string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}
			
}
?>