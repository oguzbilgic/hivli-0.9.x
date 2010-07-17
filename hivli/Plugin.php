<?php
class Hivli_Plugin {
	
	private $_pluginPaths;
	private $_plugins;
	
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

	function hasPlugin(){
		$plugins = $this->_plugins->get(); 
		if(empty($plugins)){
			return FALSE;
		}
		return TRUE;
	}
	
	function addPluginPath($pluginPath){
		if (empty($this->_plugins)){
			$this->_plugins = new Object;
		}
		$this->_pluginPaths[] = $pluginPath;
		$this->_registerPlugins($pluginPath);
	}
	
	private function _registerPlugins($pluginPath){
		foreach ( glob ( $pluginPath.'*.php' ) as $plugin_filename ) {
			require_once $plugin_filename;
			$pluginName = str_replace('.php', '', substr($plugin_filename, strlen($pluginPath))).'Plugin';
			
			$plugin = new $pluginName;
			$orderNumber = $plugin->_orderNumber;
			$this->_plugins->$orderNumber = new $pluginName;
		}
		$this->_sortPlugins();
	}
	
	private function _sortPlugins(){
		if ($this->hasPlugin()){
			$this->_plugins->ksort();
		}
	}
	
	function runPluginAction($actionName){
		if ($this->hasPlugin()){
			foreach($this->_plugins->get() as $pluginName => $object){
				$this->_plugins->$pluginName->$actionName();
			}		
		}
	}
}