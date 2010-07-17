<?php
class Hivli_Database_Table_Abstract
{	
	var $_databaseStructure;
	var $_objectStructure;
	var $_adapter;
	
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
	
	function fetchAll(){
		return $this->_adapter->fetchAll();
	}
	
	function select($attributes = NULL, $limit = NULL, $childObjects = NULL, $orderBy = NULL){
		$parentObjects = $this->_adapter->select($attributes, $limit, $orderBy);
		
		if (isset($childObjects)){
			foreach ($childObjects as $childObject){
				$childObjectStructure = $this->_databaseStructure->getObject($this->_objectStructure->getChildObjectName($childObject));
			
				$childObjectResult = $this->_adapter->getChildObjects($attributes, $childObject, $childObjectStructure->getTableName(), $childObjectStructure->getPrimaryKey());
			
				$result = null;
				foreach ($parentObjects as $parentObject){
					array_search_in_level($parentObject[$childObject], $childObjectResult, $childObjectStructure->getPrimaryKey(), $parentObject[$childObject], 1);
					$newObjects[] =  $parentObject;
				}
				$parentObjects =  $newObjects;
			}
		}
		
		return $parentObjects;
	}
		
	function selectOne($attributes, $childObjects =NULL){
		$result = $this->select($attributes, '1', $childObjects);
		if (isset ($result[0])){
			return $result[0];
		}
		return $result[1];
	}
	
	function selectLike($attributes = NULL, $limit = NULL){
		return $this->_adapter->selectLike($attributes, $limit);
	}
	
	function add($attributes){
		$this->_adapter->add($attributes);
	}
	
	function update($newAttributes, $oldAttributes){
		$this->_adapter->update($newAttributes, $oldAttributes);
	}
	
	function delete($itemAttributes){
		$this->_adapter->delete($itemAttributes);
	}
	
}