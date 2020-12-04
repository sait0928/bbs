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

/**
 * ルーティングに関するクラス
 *
 * @package Routing
 */
class Routing
{
	/**
	 * リクエストされたURLに基づいて
	 * どのコントローラーを使うかルーティングする
	 *
	 * @param string $request_uri
	 */
	public function routing(string $request_uri): void
	{
		$url = parse_url($request_uri);
		$path = $url['path'];

		$routes = [
			'/'              => [IndexController::class, 'indexAction'],
			'/user_page'     => [UserPageController::class, 'userPageAction'],
			'/insert'        => [InsertController::class, 'insertAction'],
			'/delete'        => [DeleteController::class, 'deleteAction'],
			'/login_form'    => [LoginFormController::class, 'loginFormAction'],
			'/login'         => [LoginController::class, 'loginAction'],
			'/register_form' => [RegisterFormController::class, 'registerFormAction'],
			'/register'      => [RegisterController::class, 'registerAction'],
			'/logout'        => [LogoutController::class, 'logoutAction'],
		];

		[$classname, $action] = $routes[$path] ?? [NotFoundController::class, 'notFoundAction'];

		$controller = $classname::createDefault();
		$controller->$action();
	}
}
