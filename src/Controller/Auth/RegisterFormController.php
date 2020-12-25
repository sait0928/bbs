<?php
namespace Controller\Auth;

use View\View;

/**
 * '/register_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class RegisterFormController
{
	private View $view;

	public function __construct(
		View $view
	) {
		$this->view = $view;
	}

	/**
	 * 新規登録フォームを表示
	 */
	public function registerFormAction(): void
	{
		$this->view->render('/register_form.php');
	}
}
