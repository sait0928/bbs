<?php
namespace Controller\Auth;

use Database\Database;
use Http\CsrfToken;
use Http\Http;
use Model\User\Auth;

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
	private Database $db;

	public function __construct(
		Http $http,
		Auth $auth,
		CsrfToken $csrf_token,
		Database $db
	) {
		$this->http = $http;
		$this->auth = $auth;
		$this->csrf_token = $csrf_token;
		$this->db = $db;
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

		if(isset($_POST['name'])) {
			$sql_array['name'] = 'name = :name';
		}
		if(isset($_POST['email'])) {
			$sql_array['email'] = 'email = :email';
		}
		if(isset($_POST['pass'])) {
			$sql_array['pass'] = 'pass = :pass';
			$_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		}

		$sql = 'UPDATE users SET ';

		$count = count($sql_array);
		$i = 1;
		foreach($sql_array as $sql_element) {
			$sql = $sql . $sql_element;

			if($i < $count) {
				$sql = $sql . ', ';
				$i++;
			}
		}

		$sql = $sql . ' WHERE id = :id';

		$stmt = $this->db->getConnection()->prepare($sql);
		foreach($sql_array as $key => $sql_element) {
			$place_holder = ':' . $key;
			$stmt->bindParam($place_holder, $_POST[$key], \PDO::PARAM_STR);
		}
		$stmt->execute();

		$this->http->redirect('/');
	}
}