<?php

namespace Model\User;

use Database\Database;
use PHPUnit\Framework\TestCase;

class UserReaderTest extends TestCase
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

	public function testSelectUserById()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "name", "email", "pass")');

		$user_reader = new UserReader(
			$this->db
		);
		$user = $user_reader->selectUserById(1);
		$this->assertSame('name', $user->getUserName());
		$this->assertSame('email', $user->getEmail());
	}

	public function testSelectUserByEmail()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "name", "email", "pass")');

		$user_reader = new UserReader(
			$this->db
		);
		$user = $user_reader->selectUserByEmail('email');
		$this->assertSame(1, $user->getUserId());
		$this->assertSame('name', $user->getUserName());
	}
}
