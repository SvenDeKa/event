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
class EventRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	
	public function findByNameSubstring($fields='uid', $term, $raw=FALSE){
		
		$where = ' WHERE deleted=0 AND hidden=0';
		$where .= ' AND name LIKE \'%'.$term.'%\'';
		
		$query =$this->createQuery();
		$query->getQuerySettings()->setReturnRawQueryResult($raw);
		
		$query->statement('
			SELECT '.$fields.' 
			FROM tx_z3event_domain_model_event'.$where.'
			'); 
		return $query->execute();
	}
	
	/**
	 * 
	 */
	public function findFutureEventsByUids($uids, $showPast = 0, $limit){
		$uidArray = explode(",", $uids);
		$query = $this->createQuery();
		foreach ($uidArray as $key => $value) {
			$constraints[] =  $query->equals('uid', $value);
		}
		if( $showPast == 0 ){
			$now = new \DateTime;
			$constraints[] =  $query->greaterThanOrEqual('dates.datetimeStart', $now->format('U'));
		}
		$query->matching(
			$query->logicalAnd(
				$query->logicalOr(
					$constraints
				),
				$query->equals('hidden', 0),
				$query->equals('deleted', 0)
			)
		);
		if($limit > 0){
			$query->setLimit((integer)$limit);
		}
		$query->setOrderings($this->orderByField('uid', $uidArray));
		return $query->execute();
	}
	
	/**
	*  Set the order method
	*
	*/
	protected function orderByField($field, $values) {
		$orderings = array();
		foreach ($values as $value) {
			$orderings["$field={$value}"] = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING;
		}
		return $orderings;
	}
	
}
?>