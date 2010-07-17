<?php
class Core_Library_Test {
	
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

	function assertTrue($true, $comment){
		if ($true){
			$this->_echoOk($comment);
		} else {
			$this->_echoError($comment);
		}
	}

	function assertFalse($true, $comment){
		if (!$true){
			$this->_echoOk($comment);
		} else {
			$this->_echoError($comment);
		}
	}

	function assertEqual($var_1, $var_2, $comment = 'Unkown Test'){
		if ($var_1 == $var_2){
			$this->_echoOk($comment);
		} else {
			$this->_echoError($comment);
		}
	}
	
	function _echoOk($comment){
		echo '<div style="background-color:#00ff00">OK : '.$comment. '</div>';
	}
	function _echoError($comment){
		echo '<div style="background-color:#FF0000">ERROR : '.$comment. '</div>';
	}
}