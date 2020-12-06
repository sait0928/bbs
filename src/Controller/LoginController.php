<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Http\Session;
use Model\User\Auth;
use Model\User\SelectUser;

/**
 * '/login' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class LoginController
{
	private Session $session;
	private Http $http;
	private Auth $auth;

	public function __construct(
		Session $session,
		Http $http,
		Auth $auth
	) {
		$this->session = $session;
		$this->http = $http;
		$this->auth = $auth;
	}

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Session(),
			new Http(),
			new Auth(new SelectUser($database)),
		);
	}

	/**
	 * POST通信で送られてきたEMAILとPASSを元に
	 * ユーザーを照合して
	 * ログインする
	 */
	public function loginAction(): void
	{
		$this->session->start();

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/login_form');
		}

		$this->auth->login($_POST['email'], $_POST['pass']);

		if (!$this->auth->isLoggedIn()) {
			$this->http->redirect('/login_form');
		}

		$this->http->redirect('/');
	}
}
