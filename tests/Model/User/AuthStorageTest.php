<?php

namespace Model\User;

use Http\Session;
use PHPUnit\Framework\TestCase;

class AuthStorageTest extends TestCase
{
	/**
	 * セッション変数格納のテスト
	 */
	public function testSetStorage()
	{
		$user = new User(1, 'name', 'email', 'pass');

		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('set')
			->with('user_id', $user->getUserId())
		;

		$auth_storage = new AuthStorage(
			$session
		);
		$auth_storage->setStorage($user);
	}

	/**
	 * セッション変数確認のテスト(True)
	 */
	public function testIssetStorageTrue()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('get')
			->with('user_id')
			->willReturn(1)
		;

		$_SESSION['user_id'] = 1;
		$auth_storage = new AuthStorage(
			$session
		);
		$result = $auth_storage->issetStorage();
		$this->assertSame(true, $result);
	}

	/**
	 * セッション変数確認のテスト(False)
	 */
	public function testIssetStorageFalse()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('get')
			->with('user_id')
			->willReturn(null)
		;

		$_SESSION['user_id'] = null;
		$auth_storage = new AuthStorage(
			$session
		);
		$result = $auth_storage->issetStorage();
		$this->assertSame(false, $result);
	}

	public function testClearStorage()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('unset')
		;

		$session->expects($this->once())
			->method('destroy')
		;

		$auth_storage = new AuthStorage(
			$session
		);
		$auth_storage->clearStorage();
	}
}
