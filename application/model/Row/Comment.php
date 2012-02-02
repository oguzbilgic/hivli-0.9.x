<?
class Row_Comment extends Hivli_Database_Row {
	
	function setUp(){
		$this->addColumn('id');
		$this->addColumn('comment');
		$this->addColumn('post_id', self::COLUMN_RELATION_TOONE);
	}
}