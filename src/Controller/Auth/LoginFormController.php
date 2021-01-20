<?php
namespace Controller\Auth;

use Http\CsrfToken;
use View\ReactView;

/**
 * '/login_form' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class LoginFormController
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
	 * ログインフォームを表示
	 */
	public function loginFormAction(): void
	{
		$this->csrf_token->set();
		$csrf_token = $this->csrf_token->get();

		$params = [
			'csrf_token' => $csrf_token,
		];
		$this->react_view->render('/login_form.php', $params);
	}
}
