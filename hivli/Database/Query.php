<?
include 'Query/Abstract.php';
class Core_Library_Database_Query {
	
	private $_criterias = array();
	private $_orderBy;
	private $_limit;
	private $_join;
	private $_from;
	
	const CRITERIA_EQUAL = '=';
	const CRITERIA_NOT_EQUAL = '<>';
	const CRITERIA_GREATER_THAN = '>';
	const CRITERIA_LESS_THAN = '<';
	const CRITERIA_GREATER_EQUAL = '>=';
	const CRITERIA_LESS_EQUAL = '<=';
	const CRITERIA_IS_NULL = 'IS NULL';
	const CRITERIA_IS_NOT_NULL = 'IS NOT NULL';
	const CRITERIA_LIKE = 'LIKE';
	const CRITERIA_NOT_LIKE = 'NOT LIKE';

	const ORDER_BY_ASC = 'ASC';
	const ORDER_BY_DESC = 'DESC';
	
	function _getObjectStructure($objectName){
		return Core_Library_Loader::get('Database')->getStructure()->getObject($objectName);
	}
	
	function addCriteria($object, $column, $value, $criteriaOperator = self::CRITERIA_EQUAL){
		$criteria['table_name'] = $this->_getObjectStructure($object)->getTableName();
		$criteria['column'] = $column;
		$criteria['value'] = $value;
		$criteria['criteria_operator'] = $criteriaOperator;
		
		$this->_criterias[] = $criteria;
	}
	
	function oderBy($object, $column, $orderByOperator){
		$oderBy['table_name'] = $this->_getObjectStructure($object)->getTableName();
		$oderBy['column'] = $column;
		$oderBy['order_by_operator'] = $orderByOperator;
		
		$this->oderBy = $oderBy;		
	}
	
	function limit($limit){
		$this->_limit = $limit;
	}
	
	function join($object_1, $column_1, $object_2, $column_2){
		$join['table_name_1'] = $this->_getObjectStructure($object_1)->getTableName();
		$join['column_1'] = $column_1;
		$join['table_name_2'] = $this->_getObjectStructure($object_2)->getTableName();
		$join['column_2'] = $column_2;
		
		$this->_join = $join;
	}
	
	function from($object){
		$this->_from['table_name'] = $this->_getObjectStructure($object)->getTableName();
	}
	
	function getQuery(){
		$type = Core_Library_Loader::get('Database')->getStructure()->getDatabaseType();
		
		switch ($type) {
			case 'mysql':
				require_once 'Query/Mysql.php';
				$query = new Core_Library_Database_Query_Mysql($this->_criterias, $this->_limit, $this->_orderBy, $this->_join, $this->_from);
				return $query->getQuery();
				break;
		}
	}
}