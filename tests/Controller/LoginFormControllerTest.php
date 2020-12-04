<?php

namespace Controller;

use Http\Http;
use Http\Session;
use Model\User\Auth;
use PHPUnit\Framework\TestCase;
use View\View;

class LoginFormControllerTest extends TestCase
{
	public function testLoginFormAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->once())
			->method('isLoggedIn')
			->willReturn(false)
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->never())
			->method('redirect')
		;

		$view = $this->getMockBuilder(View::class)->getMock();
		$view->expects($this->once())
			->method('render')
			->with('/login_form.php')
		;

		$login_form_controller = new LoginFormController(
			$session,
			$auth,
			$http,
			$view
		);
		$login_form_controller->loginFormAction();
	}

	public function testLoginFormAction_IsLoggedIn()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->once())
			->method('isLoggedIn')
			->willReturn(true)
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$view = $this->getMockBuilder(View::class)->getMock();
		$view->expects($this->never())
			->method('render')
		;

		$login_form_controller = new LoginFormController(
			$session,
			$auth,
			$http,
			$view
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$login_form_controller->loginFormAction();
	}
}
