<?
class Hivli_Database_Model_Adapter_Abstract {
		
	function __construct($tableName){}
	function fetchAll(){}
	function select($attributes = NULL, $limit = NULL, $orderBy = NULL){}
	function selectLike($attributes = NULL, $limit = NULL, $orderBy = NULL){}
	function getChildObjects($attributes = NULL, $childObjectFieldName, $childObjectTabeleName, $childObjectIdFieldName){}	
	function add($attributes){}
	function update($newAttributes, $oldAttributes){}
	function delete($itemAttributes){}
}