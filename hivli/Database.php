<?
include 'Database/Row.php';
include 'Database/Table.php';
include 'Database/Query.php';

class Hivli_Database {
	
	private $_dbParams;
	private $_connection;
	private $_connectedDb;
	
	private static $_instance;
	
	private function __construcut(){
		self::getInstance();
	}
	
	public static function getInstance(){
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function setUp($dbParams){
		$this->_dbParams = $dbParams;
	}
	
	public function getConnection(){
		if (empty($this->_connection)){
			$this->_connection = mysql_connect($this->_dbParams['host'], $this->_dbParams['username'], $this->_dbParams['password']);

			mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
			mysql_query("SET CHARACTER SET utf8");
			mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");

			$this->_connectedDb = mysql_select_db($this->_dbParams['name'], $this->_connection);
		}
		
		return $this->_connection;
	}
	
	public function runQuery($query){
		mysql_query($query, $this->getConnection());
	}
	
	public function getQuery($query){
		$result = mysql_query($query, $this->getConnection());
		$rowNumber = mysql_num_rows($result);
		$i = '1';
		while($i <= $rowNumber){
			$resultArray[$i] = mysql_fetch_assoc($result);
			$i++;
		}

		if (isset($resultArray)){
			return $resultArray;
		} else {
			return FALSE;
		}
	}
	
}