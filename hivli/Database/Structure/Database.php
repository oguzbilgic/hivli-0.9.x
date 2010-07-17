<?php
include 'Database/Object.php';
class Hivli_Database_Structure_Database {
	
	function __construct($xml){
		$this->db = $xml;
	}
	
	function getDatabaseType(){
		return (string) $this->db['type'];
	}
	
	function getDatabaseName(){
		return (string) $this->db['name'];
	}
	
	function getDatabaseHost(){
		return (string) $this->db['host'];
	}
	
	function getDatabaseUsername(){
		return (string) $this->db['username'];
	}
	
	function getDatabasePassword(){
		return (string) $this->db['password'];
	}
	
	function getObject($objectName){
		foreach($this->db->object as $object){		
			if ($object['name'] == $objectName){
				return new Hivli_Database_Structure_Database_Object($object, $this->db);
			}
		}
	}
	
	function getObjectList(){
		foreach($this->db->object as $object){		
			$list[] = (string) $object['name'];
		}
		return $list;
	}
	
	function getDatabaseParams(){
		return    array('name' => $this->getDatabaseName(),
						'type' => $this->getDatabaseType(),
				  		'host' => $this->getDatabaseHost(),
						'username' => $this->getDatabaseUsername(),
						'password' => $this->getDatabasePassword());
	}
}