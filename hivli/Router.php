<?php
class Core_Library_Router {					
	
	private $_sitePath;
	private $_applications;
	private $_defaultAppName;
	private $_subdomainStatus;
	private $_subdomainList;
	private $_rules;
	private $_initRules;
	private $_url;
	
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
		
	function setParam($param, $value){
		$this->_params[$param] = $value;
	}	
	
	function setSitePath($sitePath){
		$this->_sitePath = $sitePath;
	}
	
	function setDefaultApplication($applicationName){
		$this->_defaultAppName = $applicationName;
	}
	
	function setControllerName($controller){
		$this->_params['controller'] = $controller;
	}
		
	function setActionName($action){
		$this->_params['action'] = $action;
	}
	
	function setApplicationName($application){
		$this->_params['application'] = $application;
	}
	
	function setSubdomain($subdomain){
		$this->_params['_subdomain'] = $subdomain;
	}
	
	function setDomain($domain){
		$this->_params['_domain'] = $domain;
	}
	
	function getParam($param){
		if ($this->isParam($param)){
			return urldecode($this->_params[$param]);
		}
		return NULL;
	}
	
	function getParams(){
		return $this->_params;
	}
	
	function getSelectedRuleName(){
		return $this->_selectedRule['name'];
	}
	
	function getSitePath(){
		return $this->_sitePath;
	}
	
	function getAppFolder($appName = false){
		if(!$appName){
			$appName = $this->getApplicationName();
		}
		return $this->_applications[$appName]['folder'];
	}
	
	function getAppUrlPrefix($appName){
		return $this->_applications[$appName]['url_prefix'];
	}
	
	function getRules(){
		return $this->_rules;
	}
	
	function getPost($param){
		if(isset($_POST[$param])){
			return $_POST[$param];
		}
		return NULL;
	}
	
	function getPosts(){
		if(isset($_POST)){
			return $_POST;
		}
		return NULL;
	}
	
	function getControllerName(){
		return $this->_params['controller'];
	}
	
	function getActionName(){
		return $this->_params['action'];
	}

	function getApplicationName(){
		return $this->_params['application'];
	}
	
	function getSubdomain(){
		return $this->_params['_subdomain'];
	}
	
	function getDomain(){
		return $this->_params['_domain'];
	}
	
	function hasSubdomain(){
		if ($this->isParam('_subdomain')){
			return true;
		}
		return false;
	}
	
	function hasPost(){
		if (empty($_POST)){
			return FALSE;
		}
		return TRUE;
	}
	
	function isParam($param){
		if (!empty($this->_params[$param])){
			return TRUE;
		}
		RETURN FALSE;
	}
	
	function addApplication($name, $urlPrefix, $folder){
		$this->_applications[$name] = array('name' => $name, 'url_prefix' => $urlPrefix, 'folder' => $folder);
	}

	function addRule($ruleName, $url, $params = NULL){
		if ($params){
			$this->_initRules[$ruleName] = array('url' => $url, 'param' => $params);
		} else {
			$this->_initRules[$ruleName] = array('url' => $url);
		}
		$this->reviseRules($this->_initRules);
	}
	
	
	
	
	
	

	function detectApp(){
		$this->_detectAppUri();
		$this->_detectSubdomain();
	}
	
	function _detectAppUri(){
		$url = substr($_SERVER['REQUEST_URI'], strlen($this->_sitePath));
		$applications = $this->_applications;
		
		$this->_url = $url;
		$this->setApplicationName($this->_defaultAppName);
		
		foreach ($applications as $application){
			$application['url_prefix'] = '/'.$application['url_prefix'];
			$applicationUrlPrefix = explode('/', $application['url_prefix']);
			$applicationUrlPrefix = $applicationUrlPrefix[1];
			$applicationUrlPrefixCharNum = strlen($application['url_prefix']);
			$urlPrefix = explode('/', $url);
			$urlPrefix = $urlPrefix[1];
			if ($urlPrefix == $applicationUrlPrefix){
				$this->setApplicationName($application['name']);
				$newUrl = substr($url, $applicationUrlPrefixCharNum-1);
				$this->_url = $newUrl;
			}	
		}
	}
	
	private function _detectSubdomain(){
		$host = $_SERVER['HTTP_HOST'];
		$hostArray = explode('.', $host);
		$this->setSubdomain($hostArray[0]);
		if (isset($hostArray[1]) AND isset($hostArray[2])) {
			$this->setDomain($hostArray[1] . $hostArray[2]);
		} 
	}
	
	
	
	
	
	
	
	
	function route(){
		$this->_addBasicRules();
		$this->_explodeUrl();
		$this->_selectRule();
		$this->_routeMethod();
	}
	
	private function _addBasicRules(){
		$this->addRule('homepage', 			'/', 						array('controller' => 'index', 'action' => 'index'));
		$this->addRule('default_action', 	'/:controller', 			array('action' => 'index'));
		$this->addRule('default', 			'/:controller/:action/*'	);
		$this->addRule('default_short', 	'/:controller/:action'		);
	}
		
	private function _explodeUrl(){
		$url['url'] = $this->_url;
		$url['parts'] = explode('/', $url['url']);
		foreach ($url['parts'] as $i => $part){
			if (empty($part)){
				unset($url['parts'][$i]);
			}
		}
		$url['partNumber'] = count($url['parts']);
		$url['/Number'] = substr_count($url['url'], '/');
		
		$this->_url = $url;
	}
	
	private function _selectRule(){
		$this->_decodeMethods();
		$this->_matchMethod();
		$this->_resultMethod();
		$this->_selectMethod();
	}
	
	private function _decodeMethods(){
		foreach ($this->getRules() as $name => $method){
				$url['url'] = $method['url'];
				$url['name'] = $name;
				$url['param'] = (isset($method['param'])) ? $method['param'] : NULL ;
				$url['parts'] = explode('/', $url['url']);
				foreach ($url['parts'] as $i => $part){
					if (empty($part)){
						unset($url['parts'][$i]);
					}
				}
				$url['partNumber'] = count($url['parts']);
				$url['/Number'] = substr_count($url['url'], '/');
				
				if (isset($url['parts'][$url['partNumber']]) && $url['parts'][$url['partNumber']] == '*'){
					$url['long'] = TRUE;
				} else {
					$url['long'] = FALSE;
				}
				$decodedMethods[] = $url;
		}		
		$this->reviseRules($decodedMethods);
	}
	
	private function _matchMethod(){
		$url = $this->_url;
		$methods = $this->getRules();
		foreach ($methods as $method){
			if (!$method['long']){
				$method = $this->__matchShortRule($method);
			} else {
				$method = $this->__matchLongRule($method);
			}
			$matchedMethods[] = $method;
		}
		$this->reviseRules($matchedMethods);
	}
		
	private function _resultMethod(){
		$methods = $this->getRules();
		foreach ($methods as $method){
			$method['last'] = 'ok';
			foreach ($method['result'] as $i => $result){
				if ($result == '!'){
					$method['last'] = '!';
				}
			}
			$resultedMethods[] = $method;
		}
		$this->reviseRules($resultedMethods);
	}
	
	private function _selectMethod(){
		$methods = $this->getRules();
		foreach ($methods as $i => $method){
			if ($method['last'] == 'ok'){
				$ruleId = $i;
				break;
			}
		}
		$this->_selectedRule = $methods[$ruleId];
	}
	
	private function _routeMethod(){
		$method = $this->_selectedRule;
		$url = $this->_url;
		if (isset($method['param'])){
			foreach ($method['param'] as $param => $value){
				$this->setParam($param, $value);
			}
		}
		
		foreach ($method['parts'] as $i => $part){
			if (substr($part, 0, 1) == ':'){
				$this->setParam(substr($part, 1), $url['parts'][$i]);
			}
		}
		
		if (!empty($method['parts']) && $method['parts'][$method['partNumber']] == '*'){
			$a = 1;
			foreach ($url['parts'] as $i => $part){
				if ($i >= $method['partNumber']){ 
					if ( isset($url['parts'][$i+1]) && $a ==1 | $a ==3 | $a ==5){
						$this->setParam($part, $url['parts'][$i+1]);
					}
					$a++;
				}
			}
		}
	}
	
	private function __matchLongRule($rule){
		$url = $this->_url;
		if ($url['partNumber'] >= $rule['partNumber']){
			foreach ($rule['parts'] as $i => $part){
				if (substr($part, 0 ,1) != ':' && $i != $rule['partNumber']){
					if ($parts == $url['parts'][$i]){
						$rule['result'][] = 'ok';
						$rule['resultDesc'][] = $rule['parts'][$i]." is same with ".$part;
					} else {
						$rule['result'][] = '!';
					}
				} else {
					$rule['result'][] = 'ok';
				}
			}
		} else {
			$rule['result'][] = '!';
			$rule['resultDesc'][] = "!!!!!Rule's Part Number is not more than url's part number";
		}
		return $rule;
	}
	
	private function __matchShortRule($rule){
		$url = $this->_url;
		if ($url['partNumber'] == $rule['partNumber']){
			if ($url['partNumber']){
				foreach ($url['parts'] as $i => $part){
					if (substr($rule['parts'][$i], 0 ,1) != ':'){
						if ($rule['parts'][$i] == $part){
							$rule['result'][] = 'ok';
							$rule['resultDesc'][] = $rule['parts'][$i]." is same with ".$part;
						} else {
							$rule['result'][] = '!';
							$rule['resultDesc'][] = '!!!!!'.$rule['parts'][$i]." is same with ".$part;
						}
					}
				}
			}
			$rule['result'][] = 'ok';
			$rule['resultDesc'][] = "Url has parts";
		} else {
			$rule['result'][] = '!';
			$rule['resultDesc'][] = "!!!!!Rule's Part Number is not equal to url's part number";
		}
		
		return $rule;
	}
	
	
	
	
	
	function redirect($params){
		$params['app'] = (isset($params['app'])) ? $params['app'] : $this->getParam('application') ;
		$params['controller'] = (isset($params['controller'])) ? $params['controller'] : $this->getParam('controller') ;
		$params['action'] = (isset($params['action'])) ? $params['action'] : $this->getParam('action') ;
		
		$url = (strlen($this->getAppUrlPrefix($params['app'])) > 1) ? $this->getAppUrlPrefix($params['app']) : NULL ;
		$url .= $params['controller'].'/';
		$url .= $params['action'].'/';
		foreach ($params as $param => $value){
			switch ($param) {
				case 'app':
				case 'controller':
				case 'action':
					break;		
				default:
					$url .= $param.'/'.$value.'/';;
					break;
			}
		}
		header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$this->_sitePath.$url );
		exit();
	}
	
	function redirectUrl($url){
		header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$url );
		exit();
	}
	
	function reviseRules($newRules){
		$this->_rules = $newRules;
	}
	
}