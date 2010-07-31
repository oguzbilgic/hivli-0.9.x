<?
class Hivli_Database_Query {
	
	function create($data, $table){
		$q="INSERT INTO `$table` "; 
		$v=''; $n=''; 

		foreach($data as $key=>$val){ 
			$n.="`$key`, "; 
			if(strtolower($val)=='null') $v.="NULL, "; 
			elseif(strtolower($val)=='now()') $v.="NOW(), "; 
			else $v.= "'".mysql_real_escape_string($val)."', "; 
		} 

		$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";
		return $q;
	}
	
	function update($data, $id, $table){
		$q="UPDATE `$table` SET "; 

		    foreach($data as $key=>$val){ 
		        if(strtolower($val)=='null') $q.= "`$key` = NULL, "; 
		        elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), "; 
		        elseif(preg_match("/^increment\((\-?\d+)\)$/i",$val,$m)) $q.= "`$key` = `$key` + $m[1], ";  
		        else $q.= "`$key`='".mysql_real_escape_string($val)."', "; 
		    } 

		return $q = rtrim($q, ', ') . ' WHERE `id` ='.$id.';';
	}
	
	function delete($id, $table){
		/*
			TODO 
		*/
	}
	
	function get(){
		/*
			TODO 
		*/
	}
}