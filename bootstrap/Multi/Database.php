<?
class Core_Bootstrap_Multi_Database extends Core_Bootstrap_Multi_Abstract {
	
	function postDetectApp(){
		require_once('hivli/Doctrine.php');
		$manager = Doctrine_Manager::getInstance();
		$manager->setAttribute(Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL);
		
		$dsn = 'mysql:dbname=hivli;host=localhost';
		$user = 'hivli';
		$password = '';
		
		$dbh = new PDO($dsn, $user, $password);
		$conn = Doctrine_Manager::connection($dbh);
		
	}
}