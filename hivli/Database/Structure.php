<?php
include 'Structure/Database.php';
class Core_library_Database_Structure {
		
	public static function createStructure($xmlFilePath){
		return new Core_library_Database_Structure_Database(simplexml_load_file($xmlFilePath));
	}
}