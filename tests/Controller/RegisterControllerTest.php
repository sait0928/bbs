<?php
namespace Controller;

use Http\Http;
use Model\User\Auth;
use Model\User\UserRegistration;
use PHPUnit\Framework\TestCase;

class RegisterControllerTest extends TestCase
{
	public function testRegisterAction()
	{
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
			$http,
			$user_registration,
			$auth
		);
		$register_controller->registerAction();
	}

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
			$auth
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}

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
		$register_controller = new RegisterController(
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
			$http,
			$user_registration,
			$auth
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$register_controller->registerAction();
	}
}
