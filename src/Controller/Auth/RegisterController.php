<?php
namespace Controller\Auth;

use Http\CsrfToken;
use Http\Http;
use Http\Validator;
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
	private Validator $validator;
	private UserRegistration $user_registration;
	private Auth $auth;
	private CsrfToken $csrf_token;

	public function __construct(
		Http $http,
		Validator $validator,
		UserRegistration $user_registration,
		Auth $auth,
		CsrfToken $csrf_token
	) {
		$this->http = $http;
		$this->validator = $validator;
		$this->user_registration = $user_registration;
		$this->auth = $auth;
		$this->csrf_token = $csrf_token;
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

		$this->validator->validateString($_POST['name'], '/register_form');
		$this->validator->validateString($_POST['email'], '/register_form');
		$this->validator->validateString($_POST['pass'], '/register_form');

		$csrf_token = $this->csrf_token->get();
		if($csrf_token !== $_POST['csrf_token'])
		{
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
