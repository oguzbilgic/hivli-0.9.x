<?php

/**
 * Hivli_Database_Table_Abstract		
 * 
 * Classwise representation of database table.
 *
 * @package hivli
 * @subpackage hivli.database
 */
class Hivli_Database_Table_Abstract {	

	/** 
	 * Structure of the database
	 *
	 * @var Hivli_Database_Structure_Database
	 */
	var $_databaseStructure;
	
	/** 
	 * Structure of the current table
	 *
	 * @var Hivli_Database_Structure_Database_Object
	 */
	var $_objectStructure;
	
	/** 
	 * Database adapter for table
	 *
	 * @var Hivli_Database_Table_Adapter_Mysql
	 */
	var $_adapter;
	
	/** 
	 * This saves neccessary resources.
	 *
	 * @param string $objectName This is object's name field in db schema
	 */
	function __construct($objectName){
		$this->_databaseStructure = Hivli::get('Database')->getStructure();
		$this->_objectStructure = Hivli::get('Database')->getStructure()->getObject($objectName);
		
		switch ($this->_databaseStructure->getDatabaseType()){
    		case 'mysql':
				require_once 'Adapter/Mysql.php';
    			$this->_adapter = new Hivli_Database_Table_Adapter_Mysql($this->_objectStructure->getTableName());
    			break;
       	}
		return $this; 
	}
	
	/** 
	 * Converts database result array to row objects
	 *
	 * @param array $object Result array of database query
	 * @return object Row object of the current table
	 */
	function _returnAsObject($object){
		$objectClassName = 'Row_' . ucfirst(strtolower($this->_objectStructure->getObjectName()));
		return new $objectClassName($object, $this->_objectStructure->getObjectName());
	}
	
	/** 
	 * Converts database result array which contains multiple objects to row object. 
	 *
	 * @param array $object Array of database results
	 * @return array Container of row objects
	 */
	function _returnAsObjects($objects){
		$containter = array();
		foreach ($objects as $object){
			$containter[] = $this->_returnAsObject($object);
		}
		return $containter;
	}
	
	/** 
	 * Fetches all data in the table
	 *
	 * @return array Container of row objects
	 */
	function fetchAll(){
		return $this->_adapter->fetchAll();
	}
	
	/**
	 * Selects data from current table
	 *
	 * @param array $attributes Wanted attributes to filter data
	 * @param int $limit Maximum result number of returning data
	 * @param array $childObjects Fields of the table which have to be converted to object
	 * @param string $orderBy 
	 * @return array Array of row objects
	 */
	function select($attributes = NULL, $limit = NULL, $childObjects = NULL, $orderBy = NULL){
		$parentObjects = $this->_adapter->select($attributes, $limit, $orderBy);
		
		if (isset($childObjects)){
			foreach ($childObjects as $childObject){
				$childObjectStructure = $this->_databaseStructure->getObject($this->_objectStructure->getChildObjectName($childObject));
			
				$childObjectResult = $this->_adapter->getChildObjects($attributes, $childObject, $childObjectStructure->getTableName(), $childObjectStructure->getPrimaryKey());
			
				$result = null;
				foreach ($parentObjects as $parentObject){
					array_search_in_level($parentObject[$childObject], $childObjectResult, 
												$childObjectStructure->getPrimaryKey(), $parentObject[$childObject], 1);
					$newObjects[] =  $parentObject;
				}
				$parentObjects =  $newObjects;
			}
		}
		
		return $this->_returnAsObjects($parentObjects);
	}
	
	/** 
	 * Selects one row from the table
	 *
	 * @param array $attributes Properities to filter table
	 * @parram array $childObjects Fields of the table which have to be converted to object
	 * @return object Row object of the current table
	 */	
	function selectOne($attributes, $childObjects = NULL){
		$result = $this->select($attributes, '1', $childObjects);
		if (isset ($result[0])){
			return $result[0];
		}
		return $result[1];
	}
	
	/** 
	 * Selects data row from the table
	 *
	 * @param array $attributes Properities to filter table
	 * @parram int $limit Fields of the table which have to be converted to object
	 * @return object Row object of the current table
	 */	
	function selectLike($attributes = NULL, $limit = NULL){
		return $this->_adapter->selectLike($attributes, $limit);
	}
	
	/** 
	 * Adds data to table
	 *
	 * @param array $attributes Properities to filter table
	 */
	function add($attributes){
		$this->_adapter->add($attributes);
	}
	
	/**
	 * Updates row of the table
	 *
	 * @param array $newAttributes Properities which will be updated
	 * @param array $oldAttributes Properities to select row
	 */
	function update($newAttributes, $oldAttributes){
		$this->_adapter->update($newAttributes, $oldAttributes);
	}
	
	/**
	 * Deletes row of the data
	 *
	 * @param array $itemAttributes Properities to select row
	 */
	function delete($itemAttributes){
		$this->_adapter->delete($itemAttributes);
	}
}