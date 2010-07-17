<?php
class Hivli_Database_Table_Adapter_Mysql {
	
	var $_tableName;
	var $_dabataseStructure;
	
	function __construct($tableName){	
		$this->_tableName = $tableName;
		$this->_databaseStructure = Hivli::get('database')->getStructure();
	}
	
	function fetchAll(){
		return Hivli::get('database')->newQuery('SELECT * FROM  '.$this->_tableName);
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
		
		return Hivli::get('database')->newQuery($query);
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

		return Hivli::get('database')->newQuery($query);
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
		
		$query = 'INSERT INTO `'.$this->_databaseStructure->getDatabaseName().'`.`'.$this->_tableName.'` ';
		$query = $query.' ( '.$fields.' ) VALUES ( '.$values.' ) ';
		
		Hivli::get('database')->newQuery($query);
	}
	
	function update($newAttributes, $oldAttributes){
		$query = 'UPDATE `'.$this->_databaseStructure->getDatabaseName().'`.`'.$this->_tableName.'` SET ';
		
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
		
		Hivli::get('database')->newQuery($query);
	}
	
	function delete($itemAttributes){
		$query = "DELETE FROM `".$this->_databaseStructure->getDatabaseName()."` . `".$this->_tableName."` WHERE ";
		
		$attributeNum = 0;
		foreach ($itemAttributes as $field => $value){
			if($attributeNum == '0'){
				$query.= "`".$field."` = '".$value."' ";
			} else {
				$query.= " AND `".$field."` = '".$value."'";
			}
			$attributeNum++;
		}
		
		Hivli::get('database')->newQuery($query);
	}
}