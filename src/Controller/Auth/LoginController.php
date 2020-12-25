<?php
namespace Controller\Auth;

use Http\Http;
use Model\User\Auth;

/**
 * '/login' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class LoginController
{
	private Http $http;
	private Auth $auth;

	public function __construct(
		Http $http,
		Auth $auth
	) {
		$this->http = $http;
		$this->auth = $auth;
	}

	/**
	 * POST通信で送られてきたEMAILとPASSを元に
	 * ユーザーを照合して
	 * ログインする
	 */
	public function loginAction(): void
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/login_form');
		}

		$this->auth->login($_POST['email'], $_POST['pass']);
		if(!$this->auth->isLoggedIn()) {
			$this->http->redirect('/login_form');
		}

		$this->http->redirect('/');
	}
}
