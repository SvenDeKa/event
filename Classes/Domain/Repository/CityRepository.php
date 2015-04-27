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
class CityRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * __construct
	 *
	 */
	public function __construct() {
		$this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		
		$this->configurationManager = $this->objectManager->get('TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface');
		
		$this->settings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Z3Event', 'Event'
		);	
		
		
		$this->persistenceManager = $this->objectManager->get('Tx_Extbase_Persistence_Manager');
	}
	
	
	public function findAll(){
		
		$where = '';
		
		$query = $this->persistenceManager->createQueryForType('\TYPO3\Z3Event\Domain\Model\City');				
//		$query = $this->createQuery();
		$query->getQuerySettings()->setReturnRawQueryResult(TRUE);
		
		$query->statement('
			SELECT DISTINCT city as name, GROUP_CONCAT(DISTINCT uid ORDER BY uid) AS locations 
			FROM tx_z3event_domain_model_location'.$where.'
			GROUP BY city
			'); 
		$res = $query->execute();
		$cities = array();
		foreach($res as $index => $value){
			$city = $this->objectManager->get('\TYPO3\Z3Event\Domain\Model\City');
			$city->setName($value['name']);
			$city->setLocations($value['locations']);
			$cities[]=$city;
		}
		
		return $cities;
	}
	
}
?>