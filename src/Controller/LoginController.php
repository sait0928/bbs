<?php
namespace Controller;

use Http\Http;
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
	/**
	 * POST通信で送られてきたEMAILとPASSを元に
	 * ユーザーを照合して
	 * ログインする
	 */
	public function loginAction(): void
	{
		session_start();

		$http = new Http();

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$http->redirect('/login_form');
		}

		$auth = new Auth(
			new SelectUser()
		);
		$auth->login($_POST['email'], $_POST['pass']);

		if (!$auth->isLoggedIn()) {
			$http->redirect('/login_form');
		}

		$http->redirect('/');
	}
}
