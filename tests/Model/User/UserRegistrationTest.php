<?php

namespace Model\User;

use Database\Database;
use PHPUnit\Framework\TestCase;

class UserRegistrationTest extends TestCase
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

	/**
	 * 新規登録のテスト
	 */
	public function testRegister()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');

		$user_registration = new UserRegistration(
			$this->db
		);
		$user_registration->register('name', 'email', 'pass');

		$result = $pdo->query('SELECT * FROM users')->fetchAll();
		$this->assertCount(1, $result);
		$user = current($result);
		$this->assertSame('name', $user['name']);
		$this->assertSame('email', $user['email']);
	}
}
