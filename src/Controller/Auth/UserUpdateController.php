<?php
namespace Controller\Auth;

use Http\CsrfToken;
use Http\Http;
use Http\Session;
use Model\User\Auth;
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
	private Auth $auth;
	private CsrfToken $csrf_token;
	private UserUpdate $user_update;
	private Session $session;

	public function __construct(
		Http $http,
		Auth $auth,
		CsrfToken $csrf_token,
		UserUpdate $user_update,
		Session $session
	) {
		$this->http = $http;
		$this->auth = $auth;
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

		$csrf_token = $this->csrf_token->get();
		if($csrf_token !== $_POST['csrf_token'])
		{
			$this->http->redirect('/user_update_form');
		}

		if($_POST['pass'] !== $_POST['again']) {
			$this->http->redirect('/user_update_form');
		}

		// 動的にsqlを生成する
		$sql_array = [];
		$value_array = [];

		if($_POST['name'] !== '') {
			$sql_array['name'] = 'name = :name';
			$value_array['name'] = $_POST['name'];
		}
		if($_POST['email'] !== '') {
			$sql_array['email'] = 'email = :email';
			$value_array['email'] = $_POST['email'];
		}
		if($_POST['pass'] !== '') {
			$sql_array['pass'] = 'pass = :pass';
			$value_array['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		}

		$user_id = $this->session->get('user_id');

		$this->user_update->updateUser($sql_array, $value_array, $user_id);

		$this->http->redirect('/');
	}
}