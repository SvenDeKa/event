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

class AttendeeFeUser extends \TYPO3\Z3Event\Domain\Model\Attendee {


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
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->getFeUser()->getTitle();
	}
	
	
	/**
	 * Returns the firstName
	 *
	 * @return \string $firstName
	 */
	public function getFirstName() {
//		 \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('firstname from FeUser','');
		return $this->feUser->getFirstName();
	}
	
	
	/**
	 * Returns the middleName
	 *
	 * @return \string $middleName
	 */
	public function getMiddleName() {
		return $this->feUser->getMiddleName();
	}
	
	
	/**
	 * Returns the lastName
	 *
	 * @return \string $lastName
	 */
	public function getLastName() {
		return $this->feUser->getLastName();
	}
	
	
	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return $this->feUser->getName();
	}
	
	
	/**
	 * Returns the address
	 *
	 * @return \string $address
	 */
	public function getAddress() {
		return $this->feUser->getAddress();
	}
	
	
	/**
	 * Returns the telephone
	 *
	 * @return \string $telephone
	 */
	public function getTelephone() {
		return $this->feUser->getTelephone();
	}
	
	
	/**
	 * Returns the fax
	 *
	 * @return \string $fax
	 */
	public function getFax() {
		return $this->feUser->getFax();
	}
	
	
	/**
	 * Returns the email
	 *
	 * @return \string $email
	 */
	public function getEmail() {
		return $this->feUser->getEmail();
	}
	
	
	/**
	 * Returns the zip
	 *
	 * @return \string $zip
	 */
	public function getZip() {
		return $this->feUser->getZip();
	}
	
	
	/**
	 * Returns the city
	 *
	 * @return \string $city
	 */
	public function getCity() {
		return $this->feUser->City();
	}
	
	
	/**
	 * Returns the country
	 *
	 * @return \string $country
	 */
	public function getCountry() {
		return $this->feUser->getCountry();
	}
	
	
	/**
	 * Returns the www
	 *
	 * @return \string $www
	 */
	public function getWww() {
		return $this->feUser->getWww();
	}
	
	
	/**
	 * Returns the company
	 *
	 * @return \string $company
	 */
	public function getCompany() {
		return $this->feUser->getCompany();
	}

		
}
?>