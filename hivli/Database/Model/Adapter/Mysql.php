<?php
class Hivli_Database_Model_Adapter_Mysql {
	
	var $_tableName;
	
	function __construct($tableName){	
		$this->Database = Hivli_Database::getInstance();
		$this->_tableName = $tableName;
		$this->Db = $this->Database->getStructure();
	}
	
	function fetchAll(){
		$queryId = $this->Database->newQuery('SELECT * FROM  '.$this->_tableName);
		return $this->Database->getResultAsArray($queryId);
	}
	
	function select($attributes = NULL, $limit = NULL, $orderBy = NULL){
		
		$query = 'SELECT * FROM  '.$this->_tableName.' ';
	
		$attributeNumber = 0;
		if (isset($attributes)){
			$query .= 'WHERE';
			foreach ($attributes as $field => $value){
				if ($attributeNumber == 0){
					$query.= " (".$field." LIKE '".$value."' ) ";
				} else {
					$query.= "AND (".$field." LIKE '".$value."' ) ";
				}
				$attributeNumber++;
			}
		}
		
		if (isset($orderBy)){
			$query = $query.' ORDER BY  `'.$this->_tableName.'`.`'.$orderBy['0'].'` '.$orderBy['1'];
		}
		
		if (isset($limit)){
			$query = $query.' LIMIT 0,'.$limit;
		}
		
		$queryId = $this->Database->newQuery($query);
		return $this->Database->getResultAsArray($queryId);
	}	
	
	function selectLike($attributes = NULL, $limit = NULL, $orderBy = NULL){
		foreach ($attributes as $key => $value){
			$newAttributes[$key] = '%'.$value.'%';
		}
		return $this->select($newAttributes, $limit, $orderBy);
	}
	
	
	
	
	
	
	
	
	function getChildObjects($attributes = NULL, $childObjectFieldName, $childObjectTabeleName, $childObjectIdFieldName){
		$query = 'SELECT '.$childObjectTabeleName.'.*'; 
		$query .= ' FROM  '.$this->_tableName.', '.$childObjectTabeleName.' ';
		
		$attributeNumber = 0;
		if (isset($attributes)){
			$query .= 'WHERE ';
			foreach ($attributes as $field => $value){
				if ($attributeNumber == 0){
					$query.= "( ".$this->_tableName.'.'.$field." LIKE '".$value."' ) ";
				} else {
					$query.= "AND ( ".$this->_tableName.'.'.$field." LIKE '".$value."' ) ";
				}
				$attributeNumber++;
			}
		}
		
		if ($attributeNumber == 0){
			$query .= 'WHERE ('.$childObjectTabeleName.'.'.$childObjectIdFieldName.' = '.$this->_tableName.'.'.$childObjectFieldName.')';
		} else{
			$query .= 'AND ('.$childObjectTabeleName.'.'.$childObjectIdFieldName.' = '.$this->_tableName.'.'.$childObjectFieldName.')';
		}

		$queryId = $this->Database->newQuery($query);
		return $this->Database->getResultAsArray($queryId);
	}	
	
	
	function add($attributes){
		$attributeNumber = 0;
		$fields = NULL;
		$values = NULL;
		foreach ($attributes as $attribute => $value){
			if ($attributeNumber == 0){
				$fields .= ' `'.$attribute.'`';
				$values .= " '".$value."'";
			} else {
				$fields .= ', `'.$attribute.'`';
				$values .= ", '".$value."'";
			}
			$attributeNumber++;
		}
		
		$query = 'INSERT INTO `'.$this->Db->getDatabaseName().'`.`'.$this->_tableName.'` ';
		$query = $query.' ( '.$fields.' ) VALUES ( '.$values.' ) ';
		
		$this->Database->newQuery($query);
	}
	
	function update($newAttributes, $oldAttributes){
		$query = 'UPDATE `'.$this->Db->getDatabaseName().'`.`'.$this->_tableName.'` SET ';
		
		$newAttributeNum = '0';
		$oldAttributeNum = '0';
		foreach ($newAttributes as $field => $value){
			if($newAttributeNum == '0'){
				$query.= "`".$field."` = '".$value."' ";
			} else {
				$query.= " , `".$field."` = '".$value."'";
			}
			$newAttributeNum++;
		}
		$query .= ' WHERE `'.$this->_tableName.'` . ';
		foreach ($oldAttributes as $field => $value){
			if($oldAttributeNum == '0'){
				$query.= "`".$field."` = '".$value."' ";
			} else {
				$query.= " AND `".$field."` = '".$value."'";
			}
			$oldAttributeNum++;
		}
		$this->Database->newQuery($query);
	}
	
	function delete($itemAttributes){
		$query = "DELETE FROM `".$this->Db->getDatabaseName()."` . `".$this->_tableName."` WHERE ";
		
		$attributeNum = 0;
		foreach ($itemAttributes as $field => $value){
			if($attributeNum == '0'){
				$query.= "`".$field."` = '".$value."' ";
			} else {
				$query.= " AND `".$field."` = '".$value."'";
			}
			$attributeNum++;
		}
		
		$this->Database->newQuery($query);
	}
}