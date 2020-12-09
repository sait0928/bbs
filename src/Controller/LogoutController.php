<?php
namespace Controller;

use Http\Http;
use Model\User\Auth;

/**
 * '/logout' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class LogoutController
{
	private Auth $auth;
	private Http $http;

	public function __construct(
		Auth $auth,
		Http $http
	) {
		$this->auth = $auth;
		$this->http = $http;
	}

	/**
	 * ログアウトする
	 */
	public function logoutAction(): void
	{
		$this->auth->logout();

		$this->http->redirect('/login_form');
	}
}
