<?php
namespace Routing;

class Route
{
	public string $controller_class;
	public string $action;
	public array $middlewares;

	/**
	 * Route constructor.
	 * @param string $controller_class
	 * @param string $action
	 * @param array $middlewares
	 */
	public function __construct(
		string $controller_class,
		string $action,
		array $middlewares
	) {
		$this->controller_class = $controller_class;
		$this->action = $action;
		$this->middlewares = $middlewares;
	}
}
