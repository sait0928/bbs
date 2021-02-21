<?php

namespace Controller\Auth;

use PHPUnit\Framework\TestCase;
use View\View;

class RegisterFormControllerTest extends TestCase
{
	public function testRegisterFormAction()
	{
		$view = $this->getMockBuilder(View::class)->getMock();
		$view->expects($this->once())
			->method('render')
			->with('/register_form.php')
		;

		$register_form_controller = new RegisterFormController(
			$view
		);
		$register_form_controller->registerFormAction();
	}
}
