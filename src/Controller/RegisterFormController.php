<?php
namespace Controller;

use Http\Http;
use View\View;

/**
 * '/register_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * Class RegisterFormController
 * @package Controller
 */
class RegisterFormController
{
	/**
	 * 新規登録フォームを表示
	 */
	public function registerFormAction(): void
	{
		session_start();

		if(isset($_SESSION['user_id'])) {
			$http = new Http();
			$http->redirect('/');
		}

		$view = new View();
		$view->render('/register_form.php');
	}
}
