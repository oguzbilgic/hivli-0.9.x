<?php
class Hivli_Log {
	var $_logs;
	var $_functions;
	
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

	function start($functionCode, $comment = 'No comment'){
		$this->_functions[$functionCode]['function_code'] = $functionCode;
		$this->_functions[$functionCode]['call_time'] = time();
		$this->_functions[$functionCode]['start_time'] = microtime();
		$this->_functions[$functionCode]['start_comment'] = $comment;
		$this->_functions[$functionCode]['start_memory_usage'] = memory_get_usage();
		$this->_functions[$functionCode]['start_peak_memory_usage'] = memory_get_peak_usage();
	}

	function stop($functionCode, $comment = 'No comment'){
		$this->_functions[$functionCode]['stop_time'] = microtime();
		$this->_functions[$functionCode]['stop_comment'] = $comment;
		$this->_functions[$functionCode]['stop_memory_usage'] = memory_get_usage();
		$this->_functions[$functionCode]['stop_peak_memory_usage'] = memory_get_peak_usage();
		$this->_finish($functionCode);
	}
	
	function _finish($functionCode){
		$function = $this->_functions[$functionCode];
		
		$time = $function['stop_time'] - $function['start_time'];
		$this->_functions[$functionCode]['result']['time'] = $time;
		
		$memory = $function['stop_memory_usage'] - $function['start_memory_usage'];
		$this->_functions[$functionCode]['result']['memory'] = $memory;
		
		$peak = $function['stop_peak_memory_usage'] - $function['start_peak_memory_usage'];
		$this->_functions[$functionCode]['result']['peak'] = $peak;
	}
	
	function showResutls(){
		print_r($this->_functions);
	}
}