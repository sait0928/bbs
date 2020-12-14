<?php

namespace Model\Post;

use Database\Database;
use Pagination\Pagination;
use PHPUnit\Framework\TestCase;

class PostReaderTest extends TestCase
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

	public function testSelect()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "test", "email", "pass")');
		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (1, "test_post_text", 1)');

		$post_reader = new PostReader(
			$this->db,
			new Pagination()
		);
		$posts = $post_reader->select(1);
		foreach($posts as $post) {
			$this->assertSame(1, $post['post_id']);
			$this->assertSame('test_post_text', $post['post']);
			$this->assertSame(1, $post['user_id']);
		}
	}

	public function testSelectUserPosts()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "test1", "email1", "pass1")');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (2, "test2", "email2", "pass2")');
		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (1, "test_post_text1", 1)');
		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (2, "test_post_text2", 2)');

		$post_reader = new PostReader(
			$this->db,
			new Pagination()
		);
		$posts = $post_reader->selectUserPosts(1, 2);
		foreach($posts as $post) {
			$this->assertSame(2, $post['post_id']);
			$this->assertSame('test_post_text2', $post['post']);
			$this->assertSame(2, $post['user_id']);
		}
	}
}
