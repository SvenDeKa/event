<?php
namespace TYPO3\Z3Event\Domain\Model;

/**
 * 
 * FUTURE FEATURE !!
 * 
 * @ToDo: DomainModels for YEAR, MONTH, WEEK, DAY, if needed
 * 
 */


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
class Month extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
	
	/**
	 *  Month-Attributes
	 */
	
	/**
	 * year
	 *
	 * @var int
	 */
	protected $year;
	
	/**
	 * year
	 *
	 * @var int
	 */
	protected $days;
	
	/**
	 * year
	 *
	 * @var int
	 */
	protected $weeks;
	
	/**
	 * year
	 *
	 * @var \DateTime
	 */
	protected $start;
	
	/**
	 * unix-end
	 *
	 * @var \DateTime
	 */
	protected $end;
	
	/**
	 * previous Month
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Month
	 */
	protected $prevMonth;
	
	/**
	 * year
	 *
	 * @var \TYPO3\Z3Event\Domain\Model\Month
	 */
	protected $nextMonth;
}

?>
