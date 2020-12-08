<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Model\User\SelectUser;
use Model\User\UserRegistration;
use Model\User\Auth;

/**
 * '/register' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class RegisterController
{
	private Http $http;
	private UserRegistration $user_registration;
	private Auth $auth;

	public function __construct(
		Http $http,
		UserRegistration $user_registration,
		Auth $auth
	) {
		$this->http = $http;
		$this->user_registration = $user_registration;
		$this->auth = $auth;
	}

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Http(),
			new UserRegistration($database),
			new Auth(new SelectUser($database))
		);
	}

	/**
	 * POST通信で送られてきた
	 * name, email, pass を元に
	 * 新規登録する
	 */
	public function registerAction(): void
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/register_form');
		}

		if($_POST['pass'] !== $_POST['again']) {
			$this->http->redirect('/register_form');
		}

		$this->user_registration->register($_POST['name'], $_POST['email'], $_POST['pass']);

		$this->auth->login($_POST['email'], $_POST['pass']);

		if (!$this->auth->isLoggedIn()) {
			$this->http->redirect('/register_form');
		}

		$this->http->redirect('/');
	}
}
