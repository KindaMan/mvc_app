<?php 

class View {

	protected $data;
	protected $path;

	protected static function getDefaultViewPath()
	{
		$router = App::getRouter();

		if ( !$router ) {
			return FALSE;
		}

		$controller_dir = $router->getController();
		$template_name	= $router->getMethodPrefix().$router->getAction().'.html';

		return VIEWS_PATH.DS.$controller_dir.DS.$template_name;
	}

	public function __construct($data = array(), $path = NULL)
	{
		if ( !$path ) {
			$path = self::getDefaultViewPath();
		}

		if ( !file_exists($path) ) {
			throw new Exception("Template file is not found in path: ".$path);
		}

		$this->path = $path;
		$this->data = $data;
	}
}