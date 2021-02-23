<?php
namespace Controller\Auth;

use Http\CsrfToken;
use Http\Http;
use Model\User\Auth;
use Model\User\UserRegistration;
use PHPUnit\Framework\TestCase;

class RegisterControllerTest extends TestCase
{
	/**
	 * 新規登録テスト
	 */
	public function testRegisterAction()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/')
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$user_registration = $this->getMockBuilder(UserRegistration::class)
			->disableOriginalConstructor()
			->getMock();
		$user_registration->expects($this->once())
			->method('register')
			->with('hoge', 'hoge@hoge.co.jp', 'password')
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
		$_POST['pass'] = 'password';
		$_POST['again'] = 'password';
		$_POST['name'] = 'hoge';
		$_POST['email'] = 'hoge@hoge.co.jp';
		$_POST['csrf_token'] = '';
		$register_controller = new RegisterController(
			$http,
			$user_registration,
			$auth,
			$csrf_token
		);
		$register_controller->registerAction();
	}

	/**
	 * Post通信ではなかった場合
	 */
	public function testRegisterAction_NotPostRequest()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/register_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->never())
			->method('get')
		;

		$user_registration = $this->getMockBuilder(UserRegistration::class)
			->disableOriginalConstructor()
			->getMock();
		$user_registration->expects($this->never())
			->method('register')
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
		$register_controller = new RegisterController(
			$http,
			$user_registration,
			$auth,
			$csrf_token
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}

	/**
	 * パスワードの確認入力にミスがあった場合
	 */
	public function testRegisterAction_InputDifferentPassword()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/register_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$user_registration = $this->getMockBuilder(UserRegistration::class)
			->disableOriginalConstructor()
			->getMock();
		$user_registration->expects($this->never())
			->method('register')
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

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['pass'] = 'password';
		$_POST['again'] = 'different';
		$_POST['csrf_token'] = '';
		$register_controller = new RegisterController(
			$http,
			$user_registration,
			$auth,
			$csrf_token
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}

	/**
	 * ログインに失敗した場合
	 */
	public function testRegisterAction_IsNotLoggedIn()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/register_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$user_registration = $this->getMockBuilder(UserRegistration::class)
			->disableOriginalConstructor()
			->getMock();
		$user_registration->expects($this->once())
			->method('register')
			->with('hoge', 'hoge@hoge.co.jp', 'password')
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
		$_POST['pass'] = 'password';
		$_POST['again'] = 'password';
		$_POST['name'] = 'hoge';
		$_POST['email'] = 'hoge@hoge.co.jp';
		$_POST['csrf_token'] = '';
		$register_controller = new RegisterController(
			$http,
			$user_registration,
			$auth,
			$csrf_token
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}

	/**
	 * トークン認証に失敗した場合
	 */
	public function testRegisterAction_TokenMismatch()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/register_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$user_registration = $this->getMockBuilder(UserRegistration::class)
			->disableOriginalConstructor()
			->getMock();
		$user_registration->expects($this->never())
			->method('register')
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

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = 'token';
		$register_controller = new RegisterController(
			$http,
			$user_registration,
			$auth,
			$csrf_token
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}
}
