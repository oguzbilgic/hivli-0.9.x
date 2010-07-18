<?php
class Hivli_Database_Structure_Database_Object extends Hivli_Database_Structure_Database {
	
	function __construct($object, $xml){
		$this->object = $object;
		parent::__construct($xml);
	}
	
	function getObjectName(){
		return (string) $this->object['name'];
	}
	
	function getTableName(){
		return (string) $this->object['table_name'];
	}
		
	function getToStringField(){
		return (string) $this->object['to_string_field'];
	}
	
	function getFields(){
		$fields = array();
		foreach ($this->object->field as $field){
			$fields[] = $field;
		}
		return $fields;
	}
	
	function getFieldNumber(){
		return (int) count($this->getFields());
	}
	
	function getPrimaryKey(){
		foreach ($this->object->field as $field){
			if ($field['type'] == 'id'){
				return (string) $field['name'];
			}
		}
	}
	
	function hasChildObject(){
		foreach ($this->object->field as $field){
			if ($field['type'] == 'object'){
				return true;
			}
		}
		return false;
	}
	
	function getChildObjectFields(){
		foreach ($this->object->field as $field){
			if ($field['type'] == 'object'){
				$list[] = (string) $field['name'];
			}
		}
		return $list;
	}
	
	function getChildObjectName($fieldName){
		foreach ($this->object->field as $field){
			if ($field['name'] == $fieldName){
				return (string) $field['object_name'];
			}
		}
		return false;
	}
	
	function getChildObjectStringField($fieldName){
		foreach ($this->object->field as $field){
			if ($field['name'] == $fieldName){
				return (string) $this->getObject($field['object_name'])->getToStringField();
			}
		}
	}
}