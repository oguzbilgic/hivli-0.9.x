<?php
class Hivli_Bootstrap {
	
	private $_plugins;
	private $_abstract;
	private $_methodList;
		
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