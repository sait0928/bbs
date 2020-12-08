<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Model\User\Auth;
use Model\User\SelectUser;

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

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Auth(new SelectUser($database)),
			new Http
		);
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
