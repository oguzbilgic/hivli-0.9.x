<?
class Core_Bootstrap_Multi_Database extends Core_Bootstrap_Multi_Abstract {
	
	function postDetectApp(){
		Hivli::get('Database')->setUp(array('host' => 'localhost',
											'username' => 'root',
											'password' => 'root',
											'name' => 'hivli'));
	}
}