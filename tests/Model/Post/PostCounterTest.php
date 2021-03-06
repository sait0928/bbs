<?php
namespace Model\Post;

use Database\Database;
use PHPUnit\Framework\TestCase;

class PostCounterTest extends TestCase
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

	public function testCountPosts()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "test", "email", "pass")');

		$post_counter = new PostCounter($this->db);
		$result = $post_counter->countPosts();
		$this->assertSame(0, $result);

		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (1, "test_post_text", 1)');
		$result = $post_counter->countPosts();
		$this->assertSame(1, $result);

		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (2, "test_post_text", 1)');
		$result = $post_counter->countPosts();
		$this->assertSame(2, $result);
	}

	public function testCountUserPosts()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "test1", "email1", "pass1")');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (2, "test2", "email2", "pass2")');

		$post_counter = new PostCounter($this->db);
		$result = $post_counter->countUserPosts(1);
		$this->assertSame(0, $result);

		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (1, "test_post_text", 1)');
		$result = $post_counter->countUserPosts(1);
		$this->assertSame(1, $result);

		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (2, "test_post_text", 2)');
		$result = $post_counter->countUserPosts(1);
		$this->assertSame(1, $result);
	}
}
