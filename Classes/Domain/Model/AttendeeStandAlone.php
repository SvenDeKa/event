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

class AttendeeStandAlone extends \TYPO3\Z3Event\Domain\Model\Attendee {
		
	
	
	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}
	
	
	/**
	 * Returns the firstName
	 *
	 * @return \string $firstName
	 */
	public function getFirstName() {
//		 \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('firstname from StandAlone','');
		return $this->firstName;
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
	 * Returns the lastName
	 *
	 * @return \string $lastName
	 */
	public function getLastName() {
		return $this->lastName;
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
	 * Returns the address
	 *
	 * @return \string $address
	 */
	public function getAddress() {
		return $this->address;
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
	 * Returns the fax
	 *
	 * @return \string $fax
	 */
	public function getFax() {
		return $this->fax;
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
	 * Returns the zip
	 *
	 * @return \string $zip
	 */
	public function getZip() {
		return $this->zip;
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
	 * Returns the country
	 *
	 * @return \string $country
	 */
	public function getCountry() {
		return $this->country;
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
	 * Returns the company
	 *
	 * @return \string $company
	 */
	public function getCompany() {
		return $this->company;
	}	
	
}
?>