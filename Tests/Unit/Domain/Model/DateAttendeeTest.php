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
 * Test case for class \TYPO3\Z3Event\Domain\Model\DateAttendee.
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
class DateAttendeeTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\Z3Event\Domain\Model\DateAttendee
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\Z3Event\Domain\Model\DateAttendee();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getStatusReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getStatus()
		);
	}

	/**
	 * @test
	 */
	public function setStatusForIntegerSetsStatus() { 
		$this->fixture->setStatus(12);

		$this->assertSame(
			12,
			$this->fixture->getStatus()
		);
	}
	
	/**
	 * @test
	 */
	public function getDateReturnsInitialValueForDate() { }

	/**
	 * @test
	 */
	public function setDateForDateSetsDate() { }
	
	/**
	 * @test
	 */
	public function getAttendeeReturnsInitialValueForAttendee() { }

	/**
	 * @test
	 */
	public function setAttendeeForAttendeeSetsAttendee() { }
	
}
?>