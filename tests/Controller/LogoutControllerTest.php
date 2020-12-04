<?php

namespace Controller;

use Http\Http;
use Http\Session;
use Model\User\Auth;
use PHPUnit\Framework\TestCase;

class LogoutControllerTest extends TestCase
{
	public function testLogoutAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->once())
			->method('logout')
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/login_form')
		;

		$logout_controller = new LogoutController(
			$session,
			$auth,
			$http
		);
		$logout_controller->logoutAction();
	}
}
