<?
class Row_Tag extends Hivli_Database_Row {
	
	function setUp(){
		$this->addColumn('id');
		$this->addColumn('tag');
		$this->addColumn('post', self::COLUMN_RELATION_MANYTOMANY);
	}
}