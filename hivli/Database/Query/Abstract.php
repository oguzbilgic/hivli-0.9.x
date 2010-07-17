<?
class Core_Database_Query_Abstract {
	
	private $_select;
	private $_from;
	private $_where;
	private $_limit;
	
	function __construct($criterias, $limit, $orderBy, $join = NULL, $from = NULL){
		$this->_criterias = $criterias;
		$this->_limitNumber = $limit;
		$this->_orderBy = $orderBy;
		$this->_join = $join;
		$this->_from = $from;
	}
	
	function getQuery(){}
}