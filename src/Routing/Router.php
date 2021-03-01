<?php
namespace Routing;

use Controller\Auth\LoginController;
use Controller\Auth\LoginFormController;
use Controller\Auth\LogoutController;
use Controller\Auth\RegisterController;
use Controller\Auth\RegisterFormController;
use Controller\Auth\UserUpdateController;
use Controller\Auth\UserUpdateFormController;
use Controller\IndexController;
use Controller\NotFoundController;
use Controller\Post\DeleteController;
use Controller\Post\InsertController;
use Controller\UserPageController;
use Middleware\AuthMiddleware;

/**
 * ルーティングに関するクラス
 *
 * @package Router
 */
class Router
{
	private const ROUTES = [
		'login_required' => [
			'/'                 => [IndexController::class,          'indexAction'],
			'/user_page'        => [UserPageController::class,       'userPageAction'],
			'/insert'           => [InsertController::class,         'insertAction'],
			'/delete'           => [DeleteController::class,         'deleteAction'],
			'/user_update_form' => [UserUpdateFormController::class, 'userUpdateFormAction'],
			'/user_update'      => [UserUpdateController::class,     'userUpdateAction'],
			'/logout'           => [LogoutController::class,         'logoutAction'],
		],
		'before_login' => [
			'/login_form'    => [LoginFormController::class,    'loginFormAction'],
			'/login'         => [LoginController::class,        'loginAction'],
			'/register_form' => [RegisterFormController::class, 'registerFormAction'],
			'/register'      => [RegisterController::class,     'registerAction'],
		],
	];

	private const ROUTE_MIDDLEWARES = [
		'login_required' => [AuthMiddleware::class, 'isLoggedIn'],
		'before_login'   => [AuthMiddleware::class, 'isNotLoggedIn'],
	];

	public function routing(string $request_uri): Route
	{
		$url = parse_url($request_uri);
		$path = $url['path'] ?? '/not_found';
		[$controller_name, $action] = [NotFoundController::class, 'notFoundAction'];
		foreach (self::ROUTES as $group_name => $route_group) {
			if (!isset($route_group[$path])) {
				continue;
			}
			if (isset(self::ROUTE_MIDDLEWARES[$group_name])) {
				[$middleware_name, $method] = self::ROUTE_MIDDLEWARES[$group_name];
			}
			[$controller_name, $action] = $route_group[$path];
			break;
		}
		return new Route(
			$controller_name,
			$action,
			[
				'middleware_name' => $middleware_name,
				'method'          => $method
			]
		);
	}
}
