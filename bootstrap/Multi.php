<?php
include 'Multi/Abstract.php';
include 'Multi/Controller.php';
include 'Multi/Database.php';
include 'Multi/I18n.php';
include 'Multi/Model.php';
include 'Multi/Php.php';
include 'Multi/Plugin.php';
include 'Multi/Router.php';
include 'Multi/View.php';
include 'Multi/Auth.php';
class Core_Bootstrap_Multi extends Hivli_Bootstrap {

	function __construct(){
		$this->addAbstract(new Core_Bootstrap_Multi_Abstract);
		
		$this->addPlugin(new Core_Bootstrap_Multi_Router);
		$this->addPlugin(new Core_Bootstrap_Multi_Controller);
		$this->addPlugin(new Core_Bootstrap_Multi_Plugin);
		$this->addPlugin(new Core_Bootstrap_Multi_View);
		$this->addPlugin(new Core_Bootstrap_Multi_Model);
		$this->addPlugin(new Core_Bootstrap_Multi_I18n);
		$this->addPlugin(new Core_Bootstrap_Multi_Database);
		$this->addPlugin(new Core_Bootstrap_Multi_Php);
		$this->addPlugin(new Core_Bootstrap_Multi_Auth);
	}
 }