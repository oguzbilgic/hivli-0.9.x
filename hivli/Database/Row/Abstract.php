<?
include 'Validator.php';
class Hivli_Database_Row_Abstract {

	var $_initialData;
	var $_objectName;
	
	function __construct($initialData, $objectName = NULL){
		$this->_initialData = $initialData;
		$this->_objectName = (!empty($objectName)) ? $objectName : $this->_objectName ;
	}
	
	function __get($key){
		return $this->_initialData[$key];
	}
	
	function __set($key, $value){
		$this->_initialData[$key] = $value;
 	}
 	
 	function getObjectName(){
 		return $this->_objectName;
 	}
 	
 	function validate(){
 		return Hivli_Database_Row_Validator::validate($this);
 	}
}