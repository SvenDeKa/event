<?php

namespace TYPO3\Z3Event\Tests;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \TYPO3\Z3Event\Domain\Model\Event.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage z3_event
 *
 * @author Sven Külpmann <sven.kuelpmann@lenz-wie-fruehling.de>
 */
class EventTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\Z3Event\Domain\Model\Event
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\Z3Event\Domain\Model\Event();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameForStringSetsName() { 
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getCategoriesReturnsInitialValueForCategory() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function setCategoriesForObjectStorageContainingCategorySetsCategories() { 
		$category = new \TYPO3\Z3Event\Domain\Model\Category();
		$objectStorageHoldingExactlyOneCategories = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneCategories->attach($category);
		$this->fixture->setCategories($objectStorageHoldingExactlyOneCategories);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCategories,
			$this->fixture->getCategories()
		);
	}
	
	/**
	 * @test
	 */
	public function addCategoryToObjectStorageHoldingCategories() {
		$category = new \TYPO3\Z3Event\Domain\Model\Category();
		$objectStorageHoldingExactlyOneCategory = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneCategory->attach($category);
		$this->fixture->addCategory($category);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCategory,
			$this->fixture->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function removeCategoryFromObjectStorageHoldingCategories() {
		$category = new \TYPO3\Z3Event\Domain\Model\Category();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($category);
		$localObjectStorage->detach($category);
		$this->fixture->addCategory($category);
		$this->fixture->removeCategory($category);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCategories()
		);
	}
	
	/**
	 * @test
	 */
	public function getDatesReturnsInitialValueForDate() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getDates()
		);
	}

	/**
	 * @test
	 */
	public function setDatesForObjectStorageContainingDateSetsDates() { 
		$date = new \TYPO3\Z3Event\Domain\Model\Date();
		$objectStorageHoldingExactlyOneDates = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneDates->attach($date);
		$this->fixture->setDates($objectStorageHoldingExactlyOneDates);

		$this->assertSame(
			$objectStorageHoldingExactlyOneDates,
			$this->fixture->getDates()
		);
	}
	
	/**
	 * @test
	 */
	public function addDateToObjectStorageHoldingDates() {
		$date = new \TYPO3\Z3Event\Domain\Model\Date();
		$objectStorageHoldingExactlyOneDate = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneDate->attach($date);
		$this->fixture->addDate($date);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneDate,
			$this->fixture->getDates()
		);
	}

	/**
	 * @test
	 */
	public function removeDateFromObjectStorageHoldingDates() {
		$date = new \TYPO3\Z3Event\Domain\Model\Date();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($date);
		$localObjectStorage->detach($date);
		$this->fixture->addDate($date);
		$this->fixture->removeDate($date);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getDates()
		);
	}
	
	/**
	 * @test
	 */
	public function getMediaReturnsInitialValueForFileReference() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getMedia()
		);
	}

	/**
	 * @test
	 */
	public function setMediaForObjectStorageContainingFileReferenceSetsMedia() { 
		$medium = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$objectStorageHoldingExactlyOneMedia = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneMedia->attach($medium);
		$this->fixture->setMedia($objectStorageHoldingExactlyOneMedia);

		$this->assertSame(
			$objectStorageHoldingExactlyOneMedia,
			$this->fixture->getMedia()
		);
	}
	
	/**
	 * @test
	 */
	public function addMediumToObjectStorageHoldingMedia() {
		$medium = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$objectStorageHoldingExactlyOneMedium = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneMedium->attach($medium);
		$this->fixture->addMedium($medium);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneMedium,
			$this->fixture->getMedia()
		);
	}

	/**
	 * @test
	 */
	public function removeMediumFromObjectStorageHoldingMedia() {
		$medium = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($medium);
		$localObjectStorage->detach($medium);
		$this->fixture->addMedium($medium);
		$this->fixture->removeMedium($medium);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getMedia()
		);
	}
	
}
?>