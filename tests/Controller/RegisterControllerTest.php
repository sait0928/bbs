<?php
namespace Controller;

use Http\Http;
use Http\Session;
use Model\User\Auth;
use Model\User\UserRegistration;
use PHPUnit\Framework\TestCase;

class RegisterControllerTest extends TestCase
{
	public function testRegisterAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/')
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
		$register_controller = new RegisterController(
			$session,
			$http,
			$user_registration,
			$auth
		);
		$register_controller->registerAction();
	}

	public function testRegisterAction_NotPostRequest()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/register_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$user_registration = $this->getMockBuilder(UserRegistration::class)
			->disableOriginalConstructor()
			->getMock();
		$user_registration->expects($this->never())
			->method('register')
			->with('hoge', 'hoge@hoge.co.jp', 'password')
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->never())
			->method('login')
			->with('hoge@hoge.co.jp', 'password')
		;

		$auth->expects($this->never())
			->method('isLoggedIn')
			->willReturn(true)
		;

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_POST['pass'] = 'password';
		$_POST['again'] = 'password';
		$_POST['name'] = 'hoge';
		$_POST['email'] = 'hoge@hoge.co.jp';
		$register_controller = new RegisterController(
			$session,
			$http,
			$user_registration,
			$auth
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}

	public function testRegisterAction_InputDifferentPassword()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/register_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$user_registration = $this->getMockBuilder(UserRegistration::class)
			->disableOriginalConstructor()
			->getMock();
		$user_registration->expects($this->never())
			->method('register')
			->with('hoge', 'hoge@hoge.co.jp', 'password')
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->never())
			->method('login')
			->with('hoge@hoge.co.jp', 'password')
		;

		$auth->expects($this->never())
			->method('isLoggedIn')
			->willReturn(true)
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['pass'] = 'password';
		$_POST['again'] = 'different';
		$_POST['name'] = 'hoge';
		$_POST['email'] = 'hoge@hoge.co.jp';
		$register_controller = new RegisterController(
			$session,
			$http,
			$user_registration,
			$auth
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}

	public function testRegisterAction_IsNotLoggedIn()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/register_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
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
		$register_controller = new RegisterController(
			$session,
			$http,
			$user_registration,
			$auth
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}
}
