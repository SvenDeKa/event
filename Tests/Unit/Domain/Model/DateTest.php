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
 * Test case for class \TYPO3\Z3Event\Domain\Model\Date.
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
class DateTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\Z3Event\Domain\Model\Date
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\Z3Event\Domain\Model\Date();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getDatetimeStartReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setDatetimeStartForDateTimeSetsDatetimeStart() { }
	
	/**
	 * @test
	 */
	public function getDatetimeEndReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setDatetimeEndForDateTimeSetsDatetimeEnd() { }
	
	/**
	 * @test
	 */
	public function getDaylongReturnsInitialValueForOolean() { }

	/**
	 * @test
	 */
	public function setDaylongForOoleanSetsDaylong() { }
	
	/**
	 * @test
	 */
	public function getExcludeReturnsInitialValueForOolean() { }

	/**
	 * @test
	 */
	public function setExcludeForOoleanSetsExclude() { }
	
	/**
	 * @test
	 */
	public function getEventReturnsInitialValueForEvent() { }

	/**
	 * @test
	 */
	public function setEventForEventSetsEvent() { }
	
	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForLocation() { }

	/**
	 * @test
	 */
	public function setLocationForLocationSetsLocation() { }
	
	/**
	 * @test
	 */
	public function getHostsReturnsInitialValueForDateHost() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getHosts()
		);
	}

	/**
	 * @test
	 */
	public function setHostsForObjectStorageContainingDateHostSetsHosts() { 
		$host = new \TYPO3\Z3Event\Domain\Model\DateHost();
		$objectStorageHoldingExactlyOneHosts = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneHosts->attach($host);
		$this->fixture->setHosts($objectStorageHoldingExactlyOneHosts);

		$this->assertSame(
			$objectStorageHoldingExactlyOneHosts,
			$this->fixture->getHosts()
		);
	}
	
	/**
	 * @test
	 */
	public function addHostToObjectStorageHoldingHosts() {
		$host = new \TYPO3\Z3Event\Domain\Model\DateHost();
		$objectStorageHoldingExactlyOneHost = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneHost->attach($host);
		$this->fixture->addHost($host);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneHost,
			$this->fixture->getHosts()
		);
	}

	/**
	 * @test
	 */
	public function removeHostFromObjectStorageHoldingHosts() {
		$host = new \TYPO3\Z3Event\Domain\Model\DateHost();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($host);
		$localObjectStorage->detach($host);
		$this->fixture->addHost($host);
		$this->fixture->removeHost($host);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getHosts()
		);
	}
	
	/**
	 * @test
	 */
	public function getAttendeesReturnsInitialValueForDateAttendee() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getAttendees()
		);
	}

	/**
	 * @test
	 */
	public function setAttendeesForObjectStorageContainingDateAttendeeSetsAttendees() { 
		$attendee = new \TYPO3\Z3Event\Domain\Model\DateAttendee();
		$objectStorageHoldingExactlyOneAttendees = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneAttendees->attach($attendee);
		$this->fixture->setAttendees($objectStorageHoldingExactlyOneAttendees);

		$this->assertSame(
			$objectStorageHoldingExactlyOneAttendees,
			$this->fixture->getAttendees()
		);
	}
	
	/**
	 * @test
	 */
	public function addAttendeeToObjectStorageHoldingAttendees() {
		$attendee = new \TYPO3\Z3Event\Domain\Model\DateAttendee();
		$objectStorageHoldingExactlyOneAttendee = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneAttendee->attach($attendee);
		$this->fixture->addAttendee($attendee);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneAttendee,
			$this->fixture->getAttendees()
		);
	}

	/**
	 * @test
	 */
	public function removeAttendeeFromObjectStorageHoldingAttendees() {
		$attendee = new \TYPO3\Z3Event\Domain\Model\DateAttendee();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($attendee);
		$localObjectStorage->detach($attendee);
		$this->fixture->addAttendee($attendee);
		$this->fixture->removeAttendee($attendee);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getAttendees()
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