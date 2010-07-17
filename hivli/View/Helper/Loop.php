<?
function loop($modulLoopName, $modulLoopParams){
	$modulLoopParamsName = $modulLoopName ;
	
	foreach ($modulLoopParams as $value => $key){
		$keyName = $modulLoopName.'0';
		$valueName = $modulLoopName;
		
		$$keyName = $value;
		$$valueName = $key;
	
		include $this->_getFolderPath('loop').$modulLoopName.$this->_suffix['loop'];
	}
}

?>