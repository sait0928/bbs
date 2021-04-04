<?php
namespace Controller\Auth;

use Http\CsrfToken;
use View\ReactView;

class UserUpdateFormController
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

	public function userUpdateFormAction(): void
	{
		$csrf_token = $this->csrf_token->get();

		$params = [
			'csrf_token' => $csrf_token,
		];
		$this->react_view->render($params);
	}
}