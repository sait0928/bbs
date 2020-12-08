<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Model\User\Auth;
use Model\User\SelectUser;
use View\View;

/**
 * '/login_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class LoginFormController
{
	private Auth $auth;
	private Http $http;
	private View $view;

	public function __construct(
		Auth $auth,
		Http $http,
		View $view
	) {
		$this->auth = $auth;
		$this->http = $http;
		$this->view = $view;
	}

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Auth(new SelectUser($database)),
			new Http(),
			new View()
		);
	}

	/**
	 * ログインフォームを表示
	 */
	public function loginFormAction(): void
	{
		if($this->auth->isLoggedIn()) {
			$this->http->redirect('/');
		}

		$this->view->render('/login_form.php');
	}
}
