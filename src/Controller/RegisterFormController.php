<?php
namespace Controller;

use Http\Http;
use View\View;

/**
 * '/register_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class RegisterFormController
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
	 * 新規登録フォームを表示
	 */
	public function registerFormAction(): void
	{
		$this->view->render('/register_form.php');
	}
}
