<?php

namespace Controller\Auth;

use Http\CsrfToken;
use PHPUnit\Framework\TestCase;
use View\ReactView;

class RegisterFormControllerTest extends TestCase
{
	public function testRegisterFormAction()
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
			->with('/js/register_form.js')
		;

		$register_form_controller = new RegisterFormController(
			$csrf_token,
			$react_view
		);
		$register_form_controller->registerFormAction();
	}
}
