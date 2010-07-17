<?php
include 'Database/Adapter.php';
include 'Database/Model.php';
include 'Database/Structure.php';
include 'Database/Query.php';
class Hivli_Database {
	
	private $_queries;
	private $_structure;
	private $_adapter;
	
	private static $_instance;
	
	private function __construcut(){
		self::getInstance();
	}
	
	public static function getInstance(){
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	function getStructure(){
		return $this->_structure;
	}
	
	function getAdapter(){
		return $this->_adapter;
	}
	
	function connect($xmlFilePath){
		$this->_structure = Hivli_Database_Structure::createStructure($xmlFilePath);
		$this->_adapter = Hivli_Database_Adapter::createAdapter($this->getStructure()->getDatabaseType());
		
		$this->getAdapter()->setDatabaseParams($this->getStructure()->getDatabaseParams());
	}


	
	function newQuery($query){
		$queryId = rand();
		$this->_queries[$queryId]['query'] = $query;
		$result = $this->getAdapter()->runQuery($query);
		$this->_queries[$queryId]['result'] = $result;
		
		return $this->getAdapter()->getResultAsArray($result);
	}
}