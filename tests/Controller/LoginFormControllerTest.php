<?php

namespace Controller;

use PHPUnit\Framework\TestCase;
use View\View;

class LoginFormControllerTest extends TestCase
{
	public function testLoginFormAction()
	{
		$view = $this->getMockBuilder(View::class)->getMock();
		$view->expects($this->once())
			->method('render')
			->with('/login_form.php')
		;

		$login_form_controller = new LoginFormController(
			$view
		);
		$login_form_controller->loginFormAction();
	}
}
