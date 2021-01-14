<?php
namespace Controller\Auth;

use CsrfToken\CsrfToken;
use View\ReactView;

/**
 * '/register_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class RegisterFormController
{
	private CsrfToken $csrf_token;
	private ReactView $react_view;

	public function __construct(
		CsrfToken $csrf_token,
		ReactView $react_view
	) {
		$this->csrf_token = $csrf_token;
		$this->react_view = $react_view;
	}

	/**
	 * 新規登録フォームを表示
	 */
	public function registerFormAction(): void
	{
		$this->csrf_token->set();
		$csrf_token = $this->csrf_token->get();

		$params = [
			'csrf_token' => $csrf_token,
		];
		$this->react_view->render('/register_form.php', $params);
	}
}
