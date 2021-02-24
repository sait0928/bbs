<?php

namespace Controller\Auth;

use Http\CsrfToken;
use PHPUnit\Framework\TestCase;
use View\ReactView;

class LoginFormControllerTest extends TestCase
{
	public function testLoginFormAction()
	{
		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('set')
		;

		$csrf_token->expects($this->once())
			->method('get')
		;

		$react_view = $this->getMockBuilder(ReactView::class)->getMock();
		$react_view->expects($this->once())
			->method('render')
			->with('/login_form.php')
		;

		$login_form_controller = new LoginFormController(
			$csrf_token,
			$react_view
		);
		$login_form_controller->loginFormAction();
	}
}
