<?
class Hivli_Exception extends ErrorException {
	
}

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
	throw new Hivli_Exception($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");
