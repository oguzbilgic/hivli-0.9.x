<?php
include 'Bootstrap/Abstract.php';
include 'Bootstrap/Controller.php';
include 'Bootstrap/Model.php';
include 'Bootstrap/Php.php';
include 'Bootstrap/Plugin.php';
include 'Bootstrap/Router.php';
include 'Bootstrap/View.php';
class Hivli_Bootstrap {
	
	private $_plugins;
	private $_abstract;
	private $_methodList;
	
	function __construct(){
		$this->addAbstract(new Hivli_Bootstrap_Abstract);
		
		$this->addPlugin(new Hivli_Bootstrap_Router);
		$this->addPlugin(new Hivli_Bootstrap_Controller);
		$this->addPlugin(new Hivli_Bootstrap_Plugin);
		$this->addPlugin(new Hivli_Bootstrap_View);
		$this->addPlugin(new Hivli_Bootstrap_Model);
		$this->addPlugin(new Hivli_Bootstrap_Php);
	}
	
	function addPlugin($plugin){
		$this->_plugins[] = $plugin;
	}
	
	function addAbstract($abstract){
		$this->_abstract = $abstract;
		$this->_methodList = get_class_methods($abstract);
	}
	
	function run(){		
		foreach($this->_methodList as $method){
			foreach ($this->_plugins as $plugin){
				$plugin->$method();
			}
		}
	}
}