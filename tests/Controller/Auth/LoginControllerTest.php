<?php
namespace Controller\Auth;

use Http\CsrfToken;
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

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['email'] = 'hoge@hoge.co.jp';
		$_POST['pass'] = 'password';
		$_POST['csrf_token'] = '';
		$login_controller = new LoginController(
			$http,
			$auth,
			$csrf_token
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

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->never())
			->method('get')
		;

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$login_controller = new LoginController(
			$http,
			$auth,
			$csrf_token
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

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['email'] = 'hoge@hoge.co.jp';
		$_POST['pass'] = 'password';
		$_POST['csrf_token'] = '';
		$login_controller = new LoginController(
			$http,
			$auth,
			$csrf_token
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$login_controller->loginAction();
	}

	/**
	 * トークン認証に失敗した場合のテスト
	 */
	public function testLoginAction_TokenMismatch()
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

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = 'token';
		$login_controller = new LoginController(
			$http,
			$auth,
			$csrf_token
		);
		$login_controller->loginAction();
	}
}
