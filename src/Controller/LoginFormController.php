<?php
namespace Controller;

use Http\Http;
use View\View;

/**
 * '/login_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class LoginFormController
{
	private Http $http;
	private View $view;

	public function __construct(
		Http $http,
		View $view
	) {
		$this->http = $http;
		$this->view = $view;
	}

	public static function createDefault()
	{
		return new self(
			new Http(),
			new View()
		);
	}

	/**
	 * ログインフォームを表示
	 */
	public function loginFormAction(): void
	{
		$this->view->render('/login_form.php');
	}
}
