<?php
include 'Adapter/Abstract.php';
include 'Adapter/Mysql.php';
class Core_Library_Database_Adapter
{	
	function createAdapter($type){
		switch ($type){
			case 'mysql':
				return new Core_Library_Database_Adapter_Mysql;
				break;
		}
	}
}