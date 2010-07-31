<?
class Bootstrap_Database extends Hivli_Bootstrap_Abstract {
	
	function postDetectApp(){
		Hivli::get('Database')->setUp(array('host' => 'localhost',
											'username' => 'root',
											'password' => 'root',
											'name' => 'hivli'));
	}
}