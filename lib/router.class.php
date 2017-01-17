<?php 

class Router {

	protected $uri;

	protected $controller;

	protected $action;

	protected $params;

	protected $route;

	protected $language;

	protected $method_prefix;



	public function getUri()
	{
		return $this->uri;
	}

	public function getController()
	{
		return $this->controller;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getParams()
	{
		return $this->params;
	}

	public function getRoute()
	{
		return $this->route;
	}

	public function getMethodPrefix()
	{
		return $this->method_prefix;
	}

	public function getLanguage()
	{
		return $this->language;
	}

	public function __construct($uri)
	{
		$this->uri = urldecode(trim($uri, '/'));

		// получаем настройки по умолчанию
		$routes 				= Config::get('routes');
		$this->route 			= Config::get('default_route');
		$this->action 			= Config::get('default_action');
		$this->language 		= Config::get('default_language');
		$this->controller 		= Config::get('default_controller');
		$this->method_prefix 	= isset($routes[$this->route]) ? $routes[$this->route]: '';

		// разбираем uri
		$uri_parts 				= explode('?', $this->uri);
		$path 					= $uri_parts[0];
		$path_parts 			= explode('/', $path);

		/*print "<pre>";
		print_r($path_parts);
		print "</pre>";*/
		
		if ( count($path_parts) ) {
			
			// получаем маршрут или язык как первый эелемент пути
			if ( in_array(strtolower(current($path_parts)), array_keys($routes)) ) {
				
				$this->route = strtolower(current($path_parts));
				$this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
				array_shift($path_parts);

			} elseif ( in_array(strtolower(current($path_parts)), Config::get('languages')) ) {
				
				$this->language = strtolower(current($path_parts));
				array_shift($path_parts);

			}

			// следующий элемент массива - контроллер
			if ( current($path_parts) ) {
				
				$this->controller = strtolower(current($path_parts));
				array_shift($path_parts);
			}

			// action 
			if ( current($path_parts) ) {
				
				$this->action = strtolower(current($path_parts));
				array_shift($path_parts);

			}

			// оставшиеся элементы - параметры
			$this->params = $path_parts;
		}

	}
}