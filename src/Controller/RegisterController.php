<?php
namespace Controller;

use Http\Http;
use Model\User\SelectUser;
use Model\User\UserRegistration;
use Model\User\Auth;

/**
 * '/register' にアクセスされた時に
 * 使用するコントローラー
 *
 * Class RegisterController
 * @package Controller
 */
class RegisterController
{
	/**
	 * POST通信で送られてきた
	 * name, email, pass を元に
	 * 新規登録する
	 */
	public function registerAction(): void
	{
		session_start();

		$http = new Http();

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$http->redirect('/register_form');
		}

		if($_POST['pass'] !== $_POST['again']) {
			$http->redirect('/register_form');
		}

		$user_registration = new UserRegistration();
		$user_registration->register($_POST['name'], $_POST['email'], $_POST['pass']);

		$auth = new Auth(
			new SelectUser()
		);
		$auth->login($_POST['email'], $_POST['pass']);

		if (!$auth->isLoggedIn()) {
			$http->redirect('/register_form');
		}

		$http->redirect('/');
	}
}
