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
 * Test case for class \TYPO3\Z3Event\Domain\Model\Category.
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
class CategoryTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\Z3Event\Domain\Model\Category
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\Z3Event\Domain\Model\Category();
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
	public function getParentReturnsInitialValueForCategory() { }

	/**
	 * @test
	 */
	public function setParentForCategorySetsParent() { }
	
	/**
	 * @test
	 */
	public function getChildrenReturnsInitialValueForCategory() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getChildren()
		);
	}

	/**
	 * @test
	 */
	public function setChildrenForObjectStorageContainingCategorySetsChildren() { 
		$child = new \TYPO3\Z3Event\Domain\Model\Category();
		$objectStorageHoldingExactlyOneChildren = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneChildren->attach($child);
		$this->fixture->setChildren($objectStorageHoldingExactlyOneChildren);

		$this->assertSame(
			$objectStorageHoldingExactlyOneChildren,
			$this->fixture->getChildren()
		);
	}
	
	/**
	 * @test
	 */
	public function addChildToObjectStorageHoldingChildren() {
		$child = new \TYPO3\Z3Event\Domain\Model\Category();
		$objectStorageHoldingExactlyOneChild = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneChild->attach($child);
		$this->fixture->addChild($child);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneChild,
			$this->fixture->getChildren()
		);
	}

	/**
	 * @test
	 */
	public function removeChildFromObjectStorageHoldingChildren() {
		$child = new \TYPO3\Z3Event\Domain\Model\Category();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($child);
		$localObjectStorage->detach($child);
		$this->fixture->addChild($child);
		$this->fixture->removeChild($child);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getChildren()
		);
	}
	
}
?>