<?php
namespace Controller;

use Http\Http;
use Http\Session;
use Model\User\Auth;
use Model\User\SelectUser;

/**
 * '/logout' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class LogoutController
{
	/**
	 * ログアウトする
	 */
	public function logoutAction(): void
	{
		$session = new Session();
		$session->start();

		$auth = new Auth(
			new SelectUser()
		);
		$auth->logout();

		$http = new Http();
		$http->redirect('/login_form');
	}
}
