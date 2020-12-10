<?php
namespace Controller;

use Http\Http;
use Model\User\Auth;
use PHPUnit\Framework\TestCase;

class LoginControllerTest extends TestCase
{
	/**
	 * ログインのテスト
	 */
	public function testLoginAction()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/')
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->once())
			->method('login')
			->with('hoge@hoge.co.jp', 'password')
		;

		$auth->expects($this->once())
			->method('isLoggedIn')
			->willReturn(true)
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['email'] = 'hoge@hoge.co.jp';
		$_POST['pass'] = 'password';
		$login_controller = new LoginController(
			$http,
			$auth
		);
		$login_controller->loginAction();
	}

	/**
	 * POST通信ではなかった場合のテスト
	 */
	public function testLoginAction_NotPostRequest()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/login_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->never())
			->method('login')
		;

		$auth->expects($this->never())
			->method('isLoggedIn')
		;

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$login_controller = new LoginController(
			$http,
			$auth
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$login_controller->loginAction();
	}

	/**
	 * ログインできなかった場合のテスト
	 */
	public function testLoginAction_IsNotLoggedIn()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/login_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->once())
			->method('login')
			->with('hoge@hoge.co.jp', 'password')
		;

		$auth->expects($this->once())
			->method('isLoggedIn')
			->willReturn(false)
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['email'] = 'hoge@hoge.co.jp';
		$_POST['pass'] = 'password';
		$login_controller = new LoginController(
			$http,
			$auth
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$login_controller->loginAction();
	}
}
