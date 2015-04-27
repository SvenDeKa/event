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
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Übergeordnete Kategorie
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Category
	 * @lazy
	 */
	protected $parent;

	/**
	 * SubKategorien
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Category>
	 * @lazy
	 */
	protected $children;

	/**
	 * events
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Event>
	 * @lazy
	 */
	protected $events;

	/**
	 * __construct
	 *
	 * @return Category
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
		$this->children = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->events = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the parent
	 *
	 * @return \TYPO3\Z3Event\Domain\Model\Category $parent
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Sets the parent
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Category $parent
	 * @return void
	 */
	public function setParent(\TYPO3\Z3Event\Domain\Model\Category $parent) {
		$this->parent = $parent;
	}

	/**
	 * Adds a Category
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Category $child
	 * @return void
	 */
	public function addChild(\TYPO3\Z3Event\Domain\Model\Category $child) {
		$this->children->attach($child);
	}

	/**
	 * Removes a Category
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Category $childToRemove The Category to be removed
	 * @return void
	 */
	public function removeChild(\TYPO3\Z3Event\Domain\Model\Category $childToRemove) {
		$this->children->detach($childToRemove);
	}

	/**
	 * Returns the children
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Category> $children
	 */
	public function getChildren() {
		return $this->children;
	}

	/**
	 * Sets the children
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Category> $children
	 * @return void
	 */
	public function setChildren(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $children) {
		$this->children = $children;
	}
	
	/**
	 * Adds a Event
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Event $event
	 * @return void
	 */
	public function addEvent(\TYPO3\Z3Event\Domain\Model\Event $event) {
		$this->events->attach($event);
	}

	/**
	 * Removes a Event
	 *
	 * @param \TYPO3\Z3Event\Domain\Model\Event $eventToRemove The Event to be removed
	 * @return void
	 */
	public function removeEvent(\TYPO3\Z3Event\Domain\Model\Event $eventToRemove) {
		$this->events->detach($eventToRemove);
	}

	/**
	 * Returns the events
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Event> $events
	 */
	public function getEvents() {
		return $this->events;
	}

	/**
	 * Sets the events
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\Z3Event\Domain\Model\Event> $events
	 * @return void
	 */
	public function setEvents(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $events) {
		$this->events = $events;
	}

}
?>