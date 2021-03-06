<?php
namespace TYPO3\Z3Event\Domain\Repository;

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
class LocationRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	public function findAllCities(){
		
		$query = $this->createQuery();
						
//		$query = $this->persistenceManager->createQueryForType('\TYPO3\Z3Event\Domain\Repository\DateRepository');
//		$query->getQuerySettings()->setReturnRawQueryResult(TRUE);

		$query->statement('
			SELECT DISTINCT city as name, GROUP_CONCAT(DISTINCT uid ORDER BY uid) AS locations 
			FROM tx_z3event_domain_model_location
			GROUP BY city
			'); 
		
		return $query->execute();
	}
	
}
?>