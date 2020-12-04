<?php
namespace Controller;

use Http\Http;
use Http\Session;
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
		return new self(
			new Session(),
			new Auth(new SelectUser()),
			new Http(),
			new View()
		);
	}

	/**
	 * ログインフォームを表示
	 */
	public function loginFormAction(): void
	{
		$this->session->start();

		if($this->auth->isLoggedIn()) {
			$this->http->redirect('/');
		}

		$this->view->render('/login_form.php');
	}
}
