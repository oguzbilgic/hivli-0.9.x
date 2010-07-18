<?php

/**
 * Hivli_Database_Structure
 * 
 * Generates structure object from database schema
 *
 * @package hivli
 * @subpackage hivli.database
 */
include 'Structure/Database.php';
class Hivli_Database_Structure {
	
	/**
	 * Creates structure object from given xml file
	 *
	 * @param string $xmlFilePath Path of the xml file
	 * @return Hivli_Database_Structure_Database 
	 */
	public static function createStructure($xmlFilePath){
		return new Hivli_Database_Structure_Database(simplexml_load_file($xmlFilePath));
	}
}