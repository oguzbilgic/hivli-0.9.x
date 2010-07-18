<?php
include 'Adapter/Abstract.php';
include 'Adapter/Mysql.php';
class Hivli_Database_Adapter {	

	function createAdapter($type){
		switch ($type){
			case 'mysql':
				return new Hivli_Database_Adapter_Mysql;
				break;
		}
	}
}