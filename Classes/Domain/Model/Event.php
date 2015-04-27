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
class Event extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;
	
	/**
	 * subtitle
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $subtitle;

	/**
	 * description
	 *
	 * @var \string
	 */
	protected $description;
	
	/**
	 * tags
	 *
	 * @var \string
	 */
	protected $tags;

	/**
	 * Kategorien
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Category>
	 * @lazy
	 */
	protected $categories;

	/**
	 * Termine
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Date>
	 * @lazy
	 */
	protected $dates;
	
	/**
	 * zukünftige Termine
	 *
	 * @var array
	 * @lazy
	 */
	protected $futureDates;

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
	 * @return Event
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
		$this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		
		$this->dates = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		
		$this->media = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the subtitle
	 *
	 * @return \string $subtitle
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * Sets the subtitle
	 *
	 * @param \string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}

	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the tags
	 *
	 * @return \string $tags
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * Sets the tags
	 *
	 * @param \string $tags
	 * @return void
	 */
	public function setTags($tags) {
		$this->tags = $tags;
	}

	/**
	 * Adds a Category
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Category $category
	 * @return void
	 */
	public function addCategory(\TYPO3\Z3Event\Domain\Model\Category $category) {
		$this->categories->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(\TYPO3\Z3Event\Domain\Model\Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Category> $categories
	 * @return void
	 */
	public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories) {
		$this->categories = $categories;
	}

	/**
	 * Adds a Date
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Date $date
	 * @return void
	 */
	public function addDate(\TYPO3\Z3Event\Domain\Model\Date $date) {
		if($this->dates === NULL){
			$this->dates = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		}
		$this->dates->attach($date);
	}

	/**
	 * Removes a Date
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Date $dateToRemove The Date to be removed
	 * @return void
	 */
	public function removeDate(\TYPO3\Z3Event\Domain\Model\Date $dateToRemove) {
		$this->dates->detach($dateToRemove);
	}

	/**
	 * Returns the dates
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Date> $dates
	 */
	public function getDates() {
		return $this->dates;
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
	 * Returns the dates
	 *
	 * @return array
	 */
	public function getFutureDates() {
		$futureDates = NULL;
		$now = new \DateTime();
		
		
		foreach($this->dates as $date){
			if($date->getdatetimeStart() >= $now){
				$futureDates[] = $date;
			}
		}
		return $futureDates;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $medium
	 * @return void
	 */
	public function addMedium(\TYPO3\CMS\Extbase\Domain\Model\FileReference $medium) {
		$this->media->attach($medium);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mediumToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeMedium(\TYPO3\CMS\Extbase\Domain\Model\FileReference $mediumToRemove) {
		$this->media->detach($mediumToRemove);
	}

	/**
	 * Returns the media
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
	 */
	public function getMedia() {
		return $this->media;
	}

	/**
	 * Sets the media
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
	 * @return void
	 */
	public function setMedia(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $media) {
		$this->media = $media;
	}

}
?>