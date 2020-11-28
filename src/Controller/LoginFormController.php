<?php
namespace Controller;

use Http\Http;
use View\View;

/**
 * '/login_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * Class LoginFormController
 * @package Controller
 */
class LoginFormController
{
	/**
	 * ログインフォームを表示
	 */
	public function loginFormAction(): void
	{
		session_start();

		if(isset($_SESSION['user_id'])) {
			$http = new Http();
			$http->redirect('/');
		}

		$view = new View();
		$view->render('/login_form.php');
	}
}
