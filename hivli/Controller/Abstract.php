<?php

include 'Abstract/Api.php';
include 'Abstract/Error.php';
include 'Abstract/Html.php';
class Hivli_Controller_Abstract {
	
	function initBase() {
		$this->view = new Object;
	}
	function initStart(){}
	function initStop(){}
	
	function getParams(){
		return $this->view->get();
	}
}