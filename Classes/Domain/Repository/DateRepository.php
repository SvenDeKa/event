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
class DateRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $defaultOrderings = array (
		'datetimeStart' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
//		'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
//		'event.name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
	);
	
	
	/**
	 * 
	 * @param \DateTime $startDate
	 * @param \DateTime $stopDate
	 * @return type
	 */
	public function findAllBetween(\DateTime $startDate, \DateTime $stopDate, $filters, $sorting) {
		
		
//		$query = $this->persistenceManager->createQueryForType('\TYPO3\Z3Event\Domain\Model\Date');
		$query = $this->createQuery();
		$query->setOrderings($this->defaultOrderings);
		
		if( is_array($sorting) ){
			$customOrdering = $this->setCustomOrdering($sorting);
			$query->setOrderings($customOrdering);
		}
		
		$constraints[0] = $query->greaterThanOrEqual('datetimeStart', $startDate->format('U'));
		$constraints[1] = $query->lessThanOrEqual('datetimeStart', $stopDate->format('U'));
	
		if(is_array($filters)){
			if(array_key_exists('city',$filters) && $filters['city'] !== NULL && $filters['city'] !== '' && $filters['city'] > 0){
				$constraints[] = $query->in('location.uid', \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',',$filters['city']));
			}
			if(array_key_exists('event',$filters) && $filters['event'] !== NULL && $filters['event'] !== ''){
				$eQuery = $this->persistenceManager->createQueryForType('\TYPO3\Z3Event\Domain\Model\Event');
				$eQuery->matching( $eQuery->like('name', '%'.$filters['event'].'%',FALSE) );
				$events = $eQuery->execute();
				$constraints[] = $query->in('event', $events);
			}
		}
		
		$query->matching($query->logicalAnd($constraints));
		
		return $query->execute();
		
	}
	
	
	public function findAllFiltered($filters=NULL, $sorting, $limit=NULL, $showPastEvents = 0){
		
		$query = $this->createQuery();
		$query->setOrderings($this->defaultOrderings);
		
		if( is_array($sorting) ){
			$customOrdering = $this->setCustomOrdering($sorting);
			$query->setOrderings($customOrdering);
		}
		$constraints = array();
		
		// only future:
		if($showPastEvents == 0){
			$now = new \DateTime();
			$constraints[] = $query->greaterThanOrEqual('datetimeStart', $now->format('U'));
		}
		
		if(is_array($filters)){
			if(array_key_exists('city',$filters) && $filters['city'] !== NULL && $filters['city'] !== '' && $filters['city'] > 0){
				$constraints[] = $query->in('location.uid', \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',',$filters['city']));
			}
			if(array_key_exists('from',$filters) && $filters['from'] !== NULL && $filters['from'] !== ''){
				$startDate = new \DateTime($filters['from']);
				$constraints[] = $query->greaterThanOrEqual('datetimeStart', $startDate->format('U'));
			}
			if(array_key_exists('until',$filters) && $filters['until'] !== NULL && $filters['until'] !== ''){
				$startDate = new \DateTime($filters['until']);
				$startDate->modify('next day');
				$constraints[] = $query->lessThan('datetimeStart', $startDate->format('U'));
			}
			if(array_key_exists('event',$filters) && $filters['event'] !== NULL && $filters['event'] !== ''){
				$eQuery = $this->persistenceManager->createQueryForType('\TYPO3\Z3Event\Domain\Model\Event');
				$eQuery->matching( $eQuery->like('name', '%'.$filters['event'].'%',FALSE) );
				$events = $eQuery->execute();
				$constraints[] = $query->in('event', $events);
			}
		}
	
		if(sizeof($constraints)>1){
			$match = $query->logicalAnd($constraints);
		}else{
			$match = $constraints[0];
		}
		if( $limit > 0 ){
			$query->setLimit((integer)$limit);
		}
		$result = $query->matching($match)->execute();
		
		return $result;
	}
	
	
	
	
	/**
	 * Change the defaultORdering of Queries
	 *
	 * @param type $sorting
	 * @return type
	 */
	private function setCustomOrdering($sorting){
		$orderings = $this->defaultOrderings;

		// push the chosen Ordering in front of the orderings-Array
		if($sorting['sortBy'] != ''){
			// take the defaultOrderings and remove the chosen Ordering
			$tmpOrderings = $this->defaultOrderings;
			unset($tmpOrderings[$sorting['sortBy']]);

			// set the chosen Ordering
			if($sorting['ordering'] == 'DESC'){
				$orderings = array(
					$sorting['sortBy'] => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
					
				);
			}else{
				$orderings = array(
					$sorting['sortBy'] => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
				);
			}
			//add the remaining defaultOrderings
			$orderings = array_merge($orderings, $tmpOrderings);
		}

		return $orderings;
	}
	
	public function findFutureDatesByHostPerson($host){
		
		
		$dhquery = $this->persistenceManager->createQueryForType('\TYPO3\Z3Event\Domain\Model\DateHost');
		$dateHosts = $dhquery->matching($dhquery->equals('host', $host))->execute();
		if(empty($dateHosts)){
			return NULL;
		}
		
		foreach($dateHosts as $dateHost){
			$dateUIDArray[] = $dateHost->getDate();	
		}
		if(!empty($dateUIDArray)){
	//		$query = $this->persistenceManager->createQueryForType('\TYPO3\Z3Event\Domain\Model\Date');
			$query = $this->createQuery();
			$query->setOrderings($this->defaultOrderings);

			$startDate = new \DateTime;
	//		$constraints[0] = $query->greaterThanOrEqual('datetimeStart', $startDate->format('U'));
	//		$constraints[1] = $query->in('hosts',$dateHostUIDArray);

	//		$query->matching($query->logicalAnd($constraints));
			$res = $query->matching($query->in('uid',$dateUIDArray))->execute();
		}else{
			$res = NULL;
		}
		
		return $res;
	}
	
}
?>