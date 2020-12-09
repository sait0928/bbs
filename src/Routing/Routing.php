<?php
namespace Routing;

use Controller\DeleteController;
use Controller\IndexController;
use Controller\InsertController;
use Controller\LoginController;
use Controller\LoginFormController;
use Controller\LogoutController;
use Controller\NotFoundController;
use Controller\RegisterController;
use Controller\RegisterFormController;
use Controller\UserPageController;
use DI\Container;
use Middleware\AuthMiddleware;

/**
 * ルーティングに関するクラス
 *
 * @package Routing
 */
class Routing
{
	private const ROUTES = [
		'login_required' => [
			'/'              => [IndexController::class,        'indexAction'],
			'/user_page'     => [UserPageController::class,     'userPageAction'],
			'/insert'        => [InsertController::class,       'insertAction'],
			'/delete'        => [DeleteController::class,       'deleteAction'],
			'/logout'        => [LogoutController::class,       'logoutAction'],
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

	public function routing(string $request_uri, Container $container): void
	{
		$url = parse_url($request_uri);
		$path = $url['path'];
		// ルートが見つからなかった時のデフォルトの設定
		[$controller_name, $action] = [NotFoundController::class, 'notFoundAction'];
		foreach (self::ROUTES as $group_name => $route_group) {
			if (!isset($route_group[$path])) {
				continue;
			}
			// ルートが見つかったので処理
			// ミドルウェアの設定されてるルートなら実行
			if (isset(self::ROUTE_MIDDLEWARES[$group_name])) {
				[$middleware_name, $method] = self::ROUTE_MIDDLEWARES[$group_name];
				$container->get($middleware_name)->$method();
			}
			[$controller_name, $action] = $route_group[$path];
			break;
		}
		// アクションを実行
		$container->get($controller_name)->$action();
	}
}
