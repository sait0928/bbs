<?php
namespace Controller;

use View\View;

/**
 * '/login_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class LoginFormController
{
	private View $view;

	public function __construct(
		View $view
	) {
		$this->view = $view;
	}

	/**
	 * ログインフォームを表示
	 */
	public function loginFormAction(): void
	{
		$this->view->render('/login_form.php');
	}
}
