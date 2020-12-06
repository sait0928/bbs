<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Http\Session;
use Model\User\Auth;
use Model\User\SelectUser;
use View\View;

/**
 * '/register_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class RegisterFormController
{
	private Session $session;
	private Auth $auth;
	private Http $http;
	private View $view;

	public function __construct(
		Session $session,
		Auth $auth,
		Http $http,
		View $view
	) {
		$this->session = $session;
		$this->auth = $auth;
		$this->http = $http;
		$this->view = $view;
	}

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Session(),
			new Auth(new SelectUser($database)),
			new Http(),
			new View()
		);
	}

	/**
	 * 新規登録フォームを表示
	 */
	public function registerFormAction(): void
	{
		$this->session->start();

		if($this->auth->isLoggedIn()) {
			$this->http->redirect('/');
		}

		$this->view->render('/register_form.php');
	}
}
