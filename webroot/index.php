<?php 
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('URI', $_SERVER['REQUEST_URI']);
define('VIEWS_PATH', ROOT.DS.'views');

require_once(ROOT.DS.'lib'.DS.'init.php');

/*$router = new Router(URI);
print "<pre>";
print_r("Route: ". $router->getRoute().PHP_EOL);
print_r("Language: ". $router->getLanguage().PHP_EOL);
print_r("Controller: ". $router->getController().PHP_EOL);
print_r("Action to be called: ". $router->getMethodPrefix().$router->getAction().PHP_EOL);
print "params: ";
print_r($router->getParams());
print "</pre>";*/

App::run(URI);
