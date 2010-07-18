<?php
class Hivli_Database_Adapter_Abstract {
	
	function setDatabaseParams($params){}
	function runQuery($query){}
	function getResultAsArray($result){}
}