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
 * Test case for class \TYPO3\Z3Event\Domain\Model\Location.
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
class LocationTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\Z3Event\Domain\Model\Location
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\Z3Event\Domain\Model\Location();
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
	public function getAddressReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAddressForStringSetsAddress() { 
		$this->fixture->setAddress('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAddress()
		);
	}
	
	/**
	 * @test
	 */
	public function getPostalCodeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPostalCodeForStringSetsPostalCode() { 
		$this->fixture->setPostalCode('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPostalCode()
		);
	}
	
	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() { 
		$this->fixture->setCity('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCity()
		);
	}
	
	/**
	 * @test
	 */
	public function getLatReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getLat()
		);
	}

	/**
	 * @test
	 */
	public function setLatForFloatSetsLat() { 
		$this->fixture->setLat(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getLat()
		);
	}
	
	/**
	 * @test
	 */
	public function getLngReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getLng()
		);
	}

	/**
	 * @test
	 */
	public function setLngForFloatSetsLng() { 
		$this->fixture->setLng(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getLng()
		);
	}
	
	/**
	 * @test
	 */
	public function getWwwReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setWwwForStringSetsWww() { 
		$this->fixture->setWww('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getWww()
		);
	}
	
	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() { 
		$this->fixture->setEmail('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getEmail()
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
	
}
?>