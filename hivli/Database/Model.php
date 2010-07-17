<?php
class Core_library_Database_Model
{
	static $_adapter;
	static $Database;
	static $Structure;
	
	function __construct($objectName){
		$this->Database = Core_library_Loader::get('Database');
		$this->Db = $this->Database->getStructure();
		$this->Object = $this->Database->getStructure()->getObject($objectName);
		
		switch ($this->Db->getDatabaseType()){
    		case 'mysql':
				require_once 'Model/Adapter/Mysql.php';
    			$this->_adapter = new Core_library_Database_Model_Adapter_Mysql($this->Object->getTableName());
    			break;
       	}
		return $this; 
	}
	
	function fetchAll(){
		return $this->_adapter->fetchAll();
	}
	
	function select($attributes = NULL, $limit = NULL, $childObjects =NULL, $orderBy = NULL){
		$parentObjects = $this->_adapter->select($attributes, $limit, $orderBy);
		if (isset($childObjects)){
			return $this->_matchObjects($attributes, $parentObjects, $childObjects);
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
	
	
	
	
	function getChildObjects($attributes = NULL, $childObjectFieldName){
		$childObjectName = $this->Object->getChildObjectName($childObjectFieldName);
		$childObjectStructure = $this->Db->getObject($childObjectName);
		
		return $this->_adapter->getChildObjects($attributes, $childObjectFieldName, $childObjectStructure->getTableName(), $childObjectStructure->getPrimaryKey());
	}
	
	
	
	function _matchObjects($attributes = NULL, $parentObjects, $childObjects){
		foreach ($childObjects as $childObject){
				$childObjectName = $this->Object->getChildObjectName($childObject);
				$childObjectStructure = $this->Db->getObject($childObjectName);
			
				$childObjectResult = $this->getChildObjects($attributes, $childObject);
				$parentObjects = matchObjects($parentObjects, $childObjectResult, $childObject, $childObject, $childObjectStructure->getPrimaryKey());
		}
		return $parentObjects;
	}
	
	
}

class Core_Model_Database {}