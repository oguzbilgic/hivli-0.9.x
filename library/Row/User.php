<?
class Row_User extends Hivli_Database_Row {
	
	function setUp(){
		$this->addColumn('id');
		$this->addColumn('name');
		$this->addColumn('username');
		$this->addColumn('password');
		$this->addColumn('email');
		$this->addColumn('post', self::COLUMN_RELATION_ONETOMANY);
	}
}