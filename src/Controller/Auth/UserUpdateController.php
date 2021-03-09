<?php
namespace Controller\Auth;

use Http\CsrfToken;
use Http\Http;
use Http\Session;
use Http\Validator;
use Model\User\UserUpdate;

/**
 * '/user_update'にアクセスされた時に
 * 使用するコントローラ
 *
 * @package Controller\Auth
 */
class UserUpdateController
{
	private Http $http;
	private Validator $validator;
	private CsrfToken $csrf_token;
	private UserUpdate $user_update;
	private Session $session;

	public function __construct(
		Http $http,
		Validator $validator,
		CsrfToken $csrf_token,
		UserUpdate $user_update,
		Session $session
	) {
		$this->http = $http;
		$this->validator = $validator;
		$this->csrf_token = $csrf_token;
		$this->user_update = $user_update;
		$this->session = $session;
	}

	/**
	 * ユーザ情報を更新する
	 */
	public function userUpdateAction(): void
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/user_update_form');
		}

		$name = $_POST['name'] ?? '';
		$email = $_POST['email'] ?? '';
		$pass = $_POST['pass'] ?? '';
		$again = $_POST['again'] ?? '';
		$post_csrf_token = $_POST['csrf_token'] ?? '';

		$this->validator->validateString($name, '/user_update_form');
		$this->validator->validateString($email, '/user_update_form');
		$this->validator->validateString($pass, '/user_update_form');
		$this->validator->validateString($again, '/user_update_form');
		$this->validator->validateString($post_csrf_token, '/user_update_form');

		if($name === '' && $email === '' && $pass === '') {
			$this->http->redirect('/user_update_form');
		}

		$csrf_token = $this->csrf_token->get();
		if($csrf_token !== $post_csrf_token)
		{
			$this->http->redirect('/user_update_form');
		}

		if($pass !== $again) {
			$this->http->redirect('/user_update_form');
		}

		$id = $this->session->get('user_id');
		$this->validator->validateInt($id, '/user_update_form');

		$this->user_update->updateUser($name, $email, $pass, $id);

		$this->http->redirect('/');
	}
}