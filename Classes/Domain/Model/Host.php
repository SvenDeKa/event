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
class Host extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	
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
	 * Name
	 * 
	 * @var \string
	 */
	protected $name;
			
			
	/**
	 * email
	 * 
	 * @var \string
	 */
	protected $email;
			
	
	/**
	 * company
	 * 
	 * @var \string
	 */
	protected $company;
	
	/**
	 * position in company
	 * 
	 * @var \string
	 */
	protected $position;
	
	/**
	 * www
	 * 
	 * @var \string
	 */
	protected $www;
			
	/**
	 * city
	 * 
	 * @var \string
	 */
	protected $city;
	
	/**
	 * vita
	 * 
	 * @var \string
	 */
	protected $vita;
			
	
	/**
	 * Bilder
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $images;

	
	/**
	 * Termine
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Date>
	 * @lazy
	 */
	protected $dates;
	

	/**
	 * __construct
	 *
	 * @return Host
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
		$this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->dates = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the vita
	 *
	 * @return \string $vita
	 */
	public function getVita() {
		return $this->vita;
	}

	/**
	 * Sets the vita
	 *
	 * @param \string $vita
	 * @return void
	 */
	public function setVita($vita) {
		$this->vita = $vita;
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
	 * Returns the position inside above company
	 *
	 * @return \string $position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Sets the position inside above company
	 *
	 * @param \string $position
	 * @return void
	 */
	public function setPosition($position) {
		$this->position = $position;
	}

//
//	/**
//	 * Adds a Date
//	 *
//	 * @param \TYPO3\Z3Event\Domain\Model\Date $date
//	 * @return void
//	 */
//	public function addDate(\TYPO3\Z3Event\Domain\Model\Date $date) {
//		$this->dates->attach($date);
//	}
//
//	/**
//	 * Removes a Date
//	 *
//	 * @param \TYPO3\Z3Event\Domain\Model\Date $dateToRemove The Date to be removed
//	 * @return void
//	 */
//	public function removeDate(\TYPO3\Z3Event\Domain\Model\Date $dateToRemove) {
//		$this->dates->detach($dateToRemove);
//	}
	
	/**
	 * Returns the dates
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Date> $dates
	 */
	public function getDates() {
		$dateRepository = new \TYPO3\Z3Event\Domain\Repository\DateRepository;
		return $dateRepository->findFutureDatesByHostPerson($this);
	}
	
	/**
	 * Sets the dates
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Date> $dates
	 * @return void
	 */
	public function setDates(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dates) {
		$this->dates = $dates;
	}

	
	
	/**
	 * Adds a
	 *
	 * @param TYPO3\CMS\Core\Resource\FileRepository $image
	 * @return void
	 */
	public function addImage(Tx_Extbase_Domain_Model_FileReference $image) {
		$this->images->attach($image);
	}

	/**
	 * Removes a
	 *
	 * @param Tx_Extbase_Domain_Model_FileReference $imageToRemove The  to be removed
	 * @return void
	 */
	public function removeImage(Tx_Extbase_Domain_Model_FileReference $imageToRemove) {
		$this->images->detach($imageToRemove);
	}

	/**
	 * Returns the images
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images) {
		$this->images = $images;
	}
}
?>