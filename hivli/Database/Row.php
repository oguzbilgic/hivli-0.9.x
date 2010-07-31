<?
class Hivli_Database_Row {
	
	var $_columns = array();
	
	const COLUMN_RELATION_NONE = 'NONE';
	const COLUMN_RELATION_MANYTOMANY = 'many to many';
	const COLUMN_RELATION_TOONE = 'to one';
	const COLUMN_RELATION_ONETOMANY = 'one to many';
	
	const COLUMN_VALIDATE_ID = 'id';
	const COLUMN_VALIDATE_EMAIL = 'email';
	const COLUMN_VALIDATE_CREATED = 'created';
	const COLUMN_VALIDATE_MODIFIED = 'modified';
	const COLUMN_VALIDATE_TIME = 'time';
	const COLUMN_VALIDATE_UNIQUE = 'unique';
	const COLUMN_VALIDATE_REQUIRED = 'required';
	const COLUMN_VALIDATE_ = '';
	
	function __construct(){
		$this->setUp();
	}
	
	function addColumn($name, $relation = self::COLUMN_RELATION_NONE, $params = array()){
		$this->_columns[$name] = array(	'name' => $name,
										'relation' => $relation,
										'params' => $params,
										'value' => '');
	}
	
	function getTableName(){
		return str_replace('Row_', '', get_class($this));
	}
	
	function getTableClassName(){
		return 'Table_' . $this->getTableName();
	}
	
	function getTableNameFromField($fieldName){
		return str_replace('_id', '', $fieldName);
	}
	
	function getRowClassNameFromField($fieldName){
		return 'Row_' . $this->getTableNameFromField($fieldName);
	}
	
	function getRowClassFromField($fieldName){
		$className = $this->getRowClassNameFromField($fieldName);
		return new $className;
	}
	
	function getTableClassNameFromField($fieldName){
		return 'Table_' . $this->getTableNameFromField($fieldName);
	}
	
	function hasRelation($relation){
		foreach($this->_columns as $column){
			if ($column['relation'] == $relation) return true;
		}
	}
	
	function getRelation($relation){
		$columns = array();
		foreach($this->_columns as $column){
			if ($column['relation'] == $relation) $columns[] = $column;
		}
		return $columns;
	}
		
	function setUp(){}
	
	protected function __get($key){
		if (isset($this->_columns[$key]['value'])){
			return $this->_columns[$key]['value'];
		} else {
			return $this->$key;
		}
	}
	
	protected function __set($key, $value){
		if (isset($this->_columns[$key]['value'])){
			switch($this->_columns[$key]['relation']){
				case self::COLUMN_RELATION_NONE:
					$this->_columns[$key]['value'] = $value;
					break;
				case self::COLUMN_RELATION_MANYTOMANY:
					/*
						TODO 
					*/
					break;
				case self::COLUMN_RELATION_TOONE:
					$this->_columns[$key]['value'] = $this->getRowClassFromField($key);
					if (is_array($value)){
						$this->_columns[$key]['value']->fromArray($value);
					} else {
						$this->_columns[$key]['value']->id = $value;
					}
					break;
				case self::COLUMN_RELATION_ONETOMANY:
					$this->_columns[$key]['value'] = array();
					foreach ($value as $number => $object){
						$this->_columns[$key]['value'][$number] = $this->getRowClassFromField($key);
						if (is_array($object)){
							$this->_columns[$key]['value'][$number]->fromArray($object);
						} elseif (is_object($object)){
							$this->_columns[$key]['value'][$number] = $object;
						} else {
							$this->_columns[$key]['value'][$number]->id = $object;
						}
					}
					break;
			}
		} else {
			$this->$key = $value;
		}
	}
	
	function fromArray($array){
		foreach($array as $key => $value){
			$this->$key = $value;
		}
	}
	
	function toArray(){
		$array = array();
		foreach($this->_columns as $field => $column){
			switch($column['relation']){
				case self::COLUMN_RELATION_NONE:
					$array[$field] = $column['value'];
					break;
				case self::COLUMN_RELATION_TOONE:
					$array[$field] = $column['value']->toArray();
					break;
				case self::COLUMN_RELATION_MANYTOMANY:
				case self::COLUMN_RELATION_ONETOMANY:
					$array[$field] = array();
					foreach($column['value'] as $number => $object){
						$array[$field][$number] -> $object->toArray();
					}
					break;
			}
		}
		return $array;
	}
	
	function validate(){
		/*
			TODO 
		*/
		return true;
	}
	
	function refresh(){
		/*
			TODO 
		*/
	}

	function save(){	
		if (!$this->validate()) return false;
	
		$array = array();
		foreach($this->_columns as $field => $column){
			if (empty($column['value'])) continue;
			switch($column['relation']){
				case self::COLUMN_RELATION_NONE:
					$array[$field] = $column['value'];
					break;
				case self::COLUMN_RELATION_TOONE:
					$column['value']->save();
					$array[$field] = $column['value']->id;
					break;
			}
		}

		$query = new Hivli_Database_Query();
		if (empty($this->_columns['id']['value'])){
			Hivli::get('Database')->runQuery($query->create($array, $this->getTableName()));
			$this->_columns['id']['value'] = mysql_insert_id();
		} else {
			Hivli::get('Database')->runQuery($query->update($array, $this->_columns['id']['value'], $this->getTableName()));
		}
		
		foreach($this->_columns as $field => $column){
			switch($column['relation']){
				case self::COLUMN_RELATION_MANYTOMANY:
					/*
						TODO 
					*/
					break;
				case self::COLUMN_RELATION_ONETOMANY:
					/*
						TODO 
					*/
					break;
			}
		}
	}
	
	function delete(){
		/*
			TODO 
		*/
	}
}