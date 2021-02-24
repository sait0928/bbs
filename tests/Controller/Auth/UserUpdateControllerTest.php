<?php

namespace Controller\Auth;

use Http\CsrfToken;
use Http\Http;
use Http\Session;
use Model\User\UserUpdate;
use PHPUnit\Framework\TestCase;

class UserUpdateControllerTest extends TestCase
{
	/**
	 * ユーザ情報更新テスト
	 */
	public function testUserUpdateAction()
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
			->willReturn('token')
		;

		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('get')
			->with('user_id')
			->willReturn(1)
		;

		$user_update = $this->getMockBuilder(UserUpdate::class)
			->disableOriginalConstructor()
			->getMock();
		$user_update->expects($this->once())
			->method('updateUser')
			->with('name', 'email', 'pass', 1)
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = 'token';
		$_POST['name'] = 'name';
		$_POST['email'] = 'email';
		$_POST['pass'] = 'pass';
		$_POST['again'] = 'pass';
		$user_update_controller = new UserUpdateController(
			$http,
			$csrf_token,
			$user_update,
			$session
		);
		$user_update_controller->userUpdateAction();
	}

	/**
	 * Post通信では無かった場合
	 */
	public function testUserUpdateAction_NotPostRequest()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/user_update_form')
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

		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->never())
			->method('get')
		;

		$user_update = $this->getMockBuilder(UserUpdate::class)
			->disableOriginalConstructor()
			->getMock();
		$user_update->expects($this->never())
			->method('updateUser')
		;

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$user_update_controller = new UserUpdateController(
			$http,
			$csrf_token,
			$user_update,
			$session
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$user_update_controller->userUpdateAction();
	}

	/**
	 * 入力が全て空欄だった場合
	 */
	public function testUserUpdateAction_Empty()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/user_update_form')
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

		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->never())
			->method('get')
		;

		$user_update = $this->getMockBuilder(UserUpdate::class)
			->disableOriginalConstructor()
			->getMock();
		$user_update->expects($this->never())
			->method('updateUser')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['name'] = '';
		$_POST['email'] = '';
		$_POST['pass'] = '';
		$_POST['again'] = '';
		$user_update_controller = new UserUpdateController(
			$http,
			$csrf_token,
			$user_update,
			$session
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$user_update_controller->userUpdateAction();
	}

	/**
	 * トークン認証に失敗した場合
	 */
	public function testUserUpdateAction_TokenMismatch()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/user_update_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
			->willReturn('token')
		;

		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->never())
			->method('get')
		;

		$user_update = $this->getMockBuilder(UserUpdate::class)
			->disableOriginalConstructor()
			->getMock();
		$user_update->expects($this->never())
			->method('updateUser')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = 'mismatch';
		$_POST['name'] = 'name';
		$_POST['email'] = 'email';
		$_POST['pass'] = 'pass';
		$_POST['again'] = 'pass';
		$user_update_controller = new UserUpdateController(
			$http,
			$csrf_token,
			$user_update,
			$session
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$user_update_controller->userUpdateAction();
	}

	/**
	 * パスワードの確認入力にミスがあった場合
	 */
	public function testUserUpdateAction_InputDifferentPassword()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/user_update_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
			->willReturn('token')
		;

		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->never())
			->method('get')
		;

		$user_update = $this->getMockBuilder(UserUpdate::class)
			->disableOriginalConstructor()
			->getMock();
		$user_update->expects($this->never())
			->method('updateUser')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = 'token';
		$_POST['name'] = 'name';
		$_POST['email'] = 'email';
		$_POST['pass'] = 'pass';
		$_POST['again'] = 'different';
		$user_update_controller = new UserUpdateController(
			$http,
			$csrf_token,
			$user_update,
			$session
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$user_update_controller->userUpdateAction();
	}
}
