<?
require_once 'hivli/Library.php';
require_once 'bootstrap/Auth.php';
require_once 'bootstrap/Database.php';
require_once 'bootstrap/I18n.php';

$bootstrap = new Hivli_Bootstrap;
//$bootstrap->addPlugin(new Bootstrap_Auth());
$bootstrap->addPlugin(new Bootstrap_Database());
$bootstrap->addPlugin(new Bootstrap_I18n());
$bootstrap->run();