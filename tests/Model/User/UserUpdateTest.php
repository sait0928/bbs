<?php

namespace Model\User;

use Database\Database;
use PHPUnit\Framework\TestCase;

class UserUpdateTest extends TestCase
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
	 * ユーザ情報更新のテスト
	 */
	public function testUpdateUser()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "name", "email", "pass")');

		$user_update = new UserUpdate(
			$this->db
		);

		$user_update->updateUser('name1', 'email1', 'pass1', 1);
		$user1 = $pdo->query('SELECT * FROM users WHERE id = 1')->fetch();
		$this->assertSame('name1', $user1['name']);
		$this->assertSame('email1', $user1['email']);

		$user_update->updateUser('name2', '', '', 1);
		$user2 = $pdo->query('SELECT * FROM users WHERE id = 1')->fetch();
		$this->assertSame('name2', $user2['name']);
		$this->assertSame('email1', $user2['email']);

		$user_update->updateUser('', 'email3', '', 1);
		$user3 = $pdo->query('SELECT * FROM users WHERE id = 1')->fetch();
		$this->assertSame('name2', $user3['name']);
		$this->assertSame('email3', $user3['email']);
	}
}
