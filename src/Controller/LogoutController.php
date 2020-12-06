<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Http\Session;
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
	private Session $session;
	private Auth $auth;
	private Http $http;

	public function __construct(
		Session $session,
		Auth $auth,
		Http $http
	) {
		$this->session = $session;
		$this->auth = $auth;
		$this->http = $http;
	}

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Session,
			new Auth(new SelectUser($database)),
			new Http
		);
	}

	/**
	 * ログアウトする
	 */
	public function logoutAction(): void
	{
		$this->session->start();

		$this->auth->logout();

		$this->http->redirect('/login_form');
	}
}
