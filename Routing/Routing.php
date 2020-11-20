<?php
namespace Routing;

class Routing
{
	function routing(string $request_uri): void
	{
		$url = parse_url($request_uri);
		$path = $url['path'];

		$controller_base = '../controllers';
		$routes = [
			'/'              => ['/index.php', 'indexAction'],
			'/user_page'     => ['/user_page.php', 'userPageAction'],
			'/insert'        => ['/insert.php', 'insertAction'],
			'/delete'        => ['/delete.php', 'deleteAction'],
			'/login_form'    => ['/login_form.php', 'loginFormAction'],
			'/login'         => ['/login.php', 'loginAction'],
			'/register_form' => ['/register_form.php', 'registerFormAction'],
			'/register'      => ['/register.php', 'registerAction'],
			'/logout'        => ['/logout.php', 'logoutAction'],
		];
		[$route, $action] = $routes[$path] ?? ['/404.php', 'notFoundAction'];

		include $controller_base . $route;
		$action();
	}
}
