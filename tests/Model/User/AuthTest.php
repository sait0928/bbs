<?php
namespace Model\User;

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
	/**
	 * ログインのテスト
	 */
	public function testLogin()
	{
		$user = new User(1, 'name', 'email', 'pass');

		$user_reader = $this->getMockBuilder(UserReader::class)
			->disableOriginalConstructor()
			->getMock();
		$user_reader->expects($this->once())
			->method('selectUserByEmail')
			->with('email')
			->willReturn($user)
		;

		$password_verifier = $this->getMockBuilder(PasswordVerifier::class)->getMock();
		$password_verifier->expects($this->once())
			->method('verifyPassword')
			->with('pass', $user)
			->willReturn(true)
		;

		$auth_storage = $this->getMockBuilder(AuthStorage::class)
			->disableOriginalConstructor()
			->getMock();
		$auth_storage->expects($this->once())
			->method('setStorage')
			->with($user)
		;

		$auth = new Auth(
			$user_reader,
			$password_verifier,
			$auth_storage
		);

		$auth->login('email', 'pass');
	}

	/**
	 * ログインに失敗した場合のテスト
	 */
	public function testLogin_Failure()
	{
		$user = new User(1, 'name', 'email', 'pass');

		$user_reader = $this->getMockBuilder(UserReader::class)
			->disableOriginalConstructor()
			->getMock();
		$user_reader->expects($this->once())
			->method('selectUserByEmail')
			->with('email')
			->willReturn($user)
		;

		$password_verifier = $this->getMockBuilder(PasswordVerifier::class)->getMock();
		$password_verifier->expects($this->once())
			->method('verifyPassword')
			->with('pass', $user)
			->willReturn(false)
		;

		$auth_storage = $this->getMockBuilder(AuthStorage::class)
			->disableOriginalConstructor()
			->getMock();
		$auth_storage->expects($this->never())
			->method('setStorage')
		;

		$auth = new Auth(
			$user_reader,
			$password_verifier,
			$auth_storage
		);

		$auth->login('email', 'pass');
	}
}
