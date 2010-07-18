<?php

include 'Abstract/Api.php';
include 'Abstract/Error.php';
include 'Abstract/Html.php';
class Hivli_Controller_Abstract {
	
	function initBase() {}
	function initStart(){}
	function initStop(){}
	
	function getParams(){}
	function getType(){}
}