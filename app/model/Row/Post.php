<?
class Row_Post extends Hivli_Database_Row {
	
	function setUp(){
		$this->addColumn('id');
		$this->addColumn('title');
		$this->addColumn('body');
		$this->addColumn('user_id', self::COLUMN_RELATION_TOONE);
		$this->addColumn('tag', self::COLUMN_RELATION_MANYTOMANY);
		$this->addColumn('comment', self::COLUMN_RELATION_ONETOMANY);
	}
}