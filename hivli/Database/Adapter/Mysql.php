<?php
class Core_Library_Database_Adapter_Mysql extends Core_Library_Database_Adapter_Abstract {
	
	var $_dbParams;
	var $_baseConnection;
	var $_baseConnectionDb;
	
	function setDatabaseParams($params){
		$this->_dbParams = $params;
		$this->_openBaseConnection();
	}
	
	private function _openBaseConnection(){
		$this->_baseConnection = mysql_connect($this->_dbParams['host'], $this->_dbParams['username'], $this->_dbParams['password']);
		
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		mysql_query("SET CHARACTER SET utf8");
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
	
		$databaseName = $this->_dbParams['name'];
		$baseConnection = $this->_baseConnection;
		$this->_baseConnectedDb = mysql_select_db($databaseName, $baseConnection);
	}
	
	function runQuery($query){
		return mysql_query($query, $this->_baseConnection);
	}
	
	function getResultAsArray($result){
		$rowNumber = mysql_num_rows($result);
		$i = '1';
		while($i <= $rowNumber){
			$resultArray[$i] = mysql_fetch_assoc($result);
			$i++;
		}
		
		if (isset($resultArray)){
			return $resultArray;
		} else {
			return FALSE;
		}
	}
}

