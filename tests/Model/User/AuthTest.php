<?php
namespace Model\User;

use Database\Database;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
	private Database $db;

	public function setUp(): void
	{
		$this->db = new Database();
		$this->db->getConnection()->beginTransaction();
	}

	public function tearDown(): void
	{
		$this->db->getConnection()->rollBack();
	}

	public function testLogin()
	{
		$user = new User(1, 'name', 'email', 'pass');

		$select_user = $this->getMockBuilder(SelectUser::class)
			->disableOriginalConstructor()
			->getMock();
		$select_user->expects($this->once())
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
			$select_user,
			$password_verifier,
			$auth_storage
		);

		$auth->login('email', 'pass');
	}

	public function testLogin_Failure()
	{
		$user = new User(1, 'name', 'email', 'pass');

		$select_user = $this->getMockBuilder(SelectUser::class)
			->disableOriginalConstructor()
			->getMock();
		$select_user->expects($this->once())
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
			$select_user,
			$password_verifier,
			$auth_storage
		);

		$auth->login('email', 'pass');
	}
}
