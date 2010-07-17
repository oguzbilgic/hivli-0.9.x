<?
class Core_Library_Database_Query_Mysql extends Core_Database_Query_Abstract {
	
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
	
	function getQuery(){
		$this->_createSelect();
		$this->_createFrom();
		$this->_createWhere();
		$this->_createLimit();
		return $this->_finish();
	}
	
	function _finish(){
		return $this->_select . $this->_from . $this->_where . $this->_limit;
	}
	
	function _createSelect(){
		if (empty($this->_join)){
			$query = 'SELECT * ';
		} else {
			$query = 'SELECT ' . $this->_join['table_name_1'] . '.* ';
		}
		
		$this->_select = $query;
	}
	
	function _createFrom(){
		if (!empty($this->_join)){
			$query = 'FROM ' . $this->_join['table_name_1'] . ', ' . $this->_join['table_name_2'];
		} else if (!empty($this->_criterias)) {
			$query = 'FROM ' . $this->_criterias[0]['table_name'];
		} else {
			$query = 'FROM ' . $this->_from['table_name'];
		}
		
		$this->_from = $query;
	}
	
	function _createWhere(){
		if (empty($this->_criterias) AND empty($this->_join)){
			return;
		}
		
		$query = ' WHERE';
		
		$criteriaNumber = '0';
		
		foreach ($this->_criterias as $criteria){
			$criteriaNumber++;
			
			if ($criteriaNumber > '1') {
				$query .= 'AND';
			}
			
			switch ($criteria['criteria_operator']){
				case Core_Library_Database_Query::CRITERIA_EQUAL :
					$query .= ' ( ' . $criteria['table_name'] . '.' . $criteria['column'] . ' = ' . $criteria['value'] . ' ) ';
					break;
				case Core_Library_Database_Query::CRITERIA_NOT_EQUAL :
					$query .= ' ( ' . $criteria['table_name'] . '.' . $criteria['column'] . ' != ' . $criteria['value'] . ' ) ';
					break;
				case Core_Library_Database_Query::CRITERIA_GREATER_THAN :
					$query .= ' ( ' . $criteria['table_name'] . '.' . $criteria['column'] . ' > ' . $criteria['value'] . ' ) ';
					break;
				case Core_Library_Database_Query::CRITERIA_LESS_THAN :
					$query .= ' ( ' . $criteria['table_name'] . '.' . $criteria['column'] . ' < ' . $criteria['value'] . ' ) ';
					break;
				case Core_Library_Database_Query::CRITERIA_GREATER_EQUAL :
					$query .= ' ( ' . $criteria['table_name'] . '.' . $criteria['column'] . ' >= ' . $criteria['value'] . ' ) ';
					break;
				case Core_Library_Database_Query::CRITERIA_LESS_EQUAL :
					$query .= ' ( ' . $criteria['table_name'] . '.' . $criteria['column'] . ' <= ' . $criteria['value'] . ' ) ';
					break;					
				case Core_Library_Database_Query::CRITERIA_LIKE :
					$query .= " ( " . $criteria['table_name'] . "." . $criteria['column'] . " LIKE '" . $criteria['value'] . "'  ) ";
					break;
				case Core_Library_Database_Query::CRITERIA_MOT_LIKE :
					$query .= ' ( ' . $criteria['table_name'] . '.' . $criteria['column'] . ' NOT LIKE ' . $criteria['value'] . ' ) ';
					break;					
					
			}	
		}
		
		//join where 
		if (!empty($this->_join)){
			$criteriaNumber++;
			
			if ($criteriaNumber > '1') {
				$query .= 'AND';
			}
			
			$query .= ' ( ' . $this->_join['table_name_1'] . '.' . $this->_join['column_1'] . ' = ' . $this->_join['table_name_2'] . '.' . $this->_join['column_2'] . ' ) ';
		}
		
		$this->_where = $query;
	}
	
	function _createLimit(){
		if (!empty($this->_limitNumber)){
			$this->_limit = ' LIMIT ' . $this->_limitNumber;
		}
	}
}