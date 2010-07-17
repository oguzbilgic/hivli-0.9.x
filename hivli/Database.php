<?php
include 'Database/Adapter.php';
include 'Database/Model.php';
include 'Database/Structure.php';
include 'Database/Query.php';
class Hivli_Database {
	
	private $_dbParams;
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
	
	function setStructure($structure){
		$this->_structure = $structure;
	}
	
	function getStructure(){
		return $this->_structure;
	}
	
	function setAdapter($adapter){
		$this->_adapter = $adapter;
	}
	
	function getAdapter(){
		return $this->_adapter;
	}
	
	
		
	function setXmlFilePath($xmlFilePath){
		$this->setStructure(Hivli_Database_Structure::createStructure($xmlFilePath));
		$this->setDatabaseParams($this->getStructure()->getDatabaseParams());		
	}

	function setDatabaseParams($params){
		$this->_dbParams = $params;
		$this->_setAdapter();
	}

	private function _setAdapter(){
		$this->setAdapter(Hivli_Database_Adapter::createAdapter($this->_dbParams['type']));
		$this->getAdapter()->setDatabaseParams($this->_dbParams);
	}

	
	
	
	
	
	function newQuery($query){
		$queryId = rand();
		$this->_queries[$queryId]['query'] = $query;
		$result = $this->getAdapter()->runQuery($query);
		$this->_queries[$queryId]['result'] = $result;
		
		return $queryId;
	}
	
	function getResultAsArray($queryId){
		$result = $this->_queries[$queryId]['result'];
		return $this->getAdapter()->getResultAsArray($result);
	}
}