<?php
include 'Structure/Database.php';
class Hivli_Database_Structure {
		
	public static function createStructure($xmlFilePath){
		return new Hivli_Database_Structure_Database(simplexml_load_file($xmlFilePath));
	}
}