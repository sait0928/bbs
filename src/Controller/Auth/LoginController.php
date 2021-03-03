<?php
namespace Controller\Auth;

use Http\CsrfToken;
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
	private CsrfToken $csrf_token;

	public function __construct(
		Http $http,
		Auth $auth,
		CsrfToken $csrf_token
	) {
		$this->http = $http;
		$this->auth = $auth;
		$this->csrf_token = $csrf_token;
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

		$csrf_token = $this->csrf_token->get();
		if($csrf_token !== $_POST['csrf_token'])
		{
			$this->http->redirect('/login_form');
		}

		if(!is_string($_POST['email']) || !is_string($_POST['pass'])) {
			$this->http->redirect('/login_form');
		}

		$this->auth->login($_POST['email'], $_POST['pass']);
		if(!$this->auth->isLoggedIn()) {
			$this->http->redirect('/login_form');
		}

		$this->http->redirect('/');
	}
}
