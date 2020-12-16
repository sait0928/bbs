<?php

namespace Controller;

use Http\Http;
use Model\User\Auth;
use PHPUnit\Framework\TestCase;

class LogoutControllerTest extends TestCase
{
	public function testLogoutAction()
	{
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
			$auth,
			$http
		);
		$logout_controller->logoutAction();
	}
}
