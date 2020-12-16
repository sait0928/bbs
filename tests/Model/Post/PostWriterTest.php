<?php
namespace Model\Post;

use Database\Database;
use PHPUnit\Framework\TestCase;

class PostWriterTest extends TestCase
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

	public function testInsert()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "test", "email", "pass")');

		$post_writer = new PostWriter($this->db);
		$post_writer->insert('test_post_text', 1);

		$result = $pdo->query('SELECT * FROM posts')->fetchAll();
		$this->assertCount(1, $result);
		$post = current($result);
		$this->assertSame('test_post_text', $post['post']);
		$this->assertSame(1, $post['user_id']);
	}

	public function testDelete()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "test", "email", "pass")');
		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (1, "test_post_text", 1)');

		$post_writer = new PostWriter($this->db);
		$post_writer->delete(1, 1);

		$result = $pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn();
		$this->assertSame(0, $result);
	}

	public function testDelete_Failure()
	{
		$pdo = $this->db->getConnection();
		$pdo->exec('DELETE FROM posts');
		$pdo->exec('DELETE FROM users');
		$pdo->exec('INSERT INTO users (id, name, email, pass) VALUES (1, "test", "email", "pass")');
		$pdo->exec('INSERT INTO posts (id, post, user_id) VALUES (1, "test_post_text", 1)');

		$post_writer = new PostWriter($this->db);
		$post_writer->delete(1, 2);

		$result = $pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn();
		$this->assertSame(1, $result);
	}
}
