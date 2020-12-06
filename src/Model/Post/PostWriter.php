<?php
namespace Model\Post;

use Database\Database;

/**
 * 記事を操作するモデル
 *
 * @package Model\Post
 */
class PostWriter
{
	private Database $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

	/**
	 * 記事を投稿
	 *
	 * @param string $text
	 * @param int $user_id
	 */
	public function insert(string $text, int $user_id): void
	{
		$stmt = $this->db->getConnection()->prepare('INSERT INTO posts (post, user_id) VALUES (:post, :user_id)');
		$stmt->bindParam(':post', $text, \PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
		$stmt->execute();
	}

	/**
	 * 記事を削除
	 *
	 * @param int $id
	 * @param int $user_id
	 */
	public function delete(int $id, int $user_id): void
	{
		$stmt = $this->db->getConnection()->prepare('DELETE FROM posts WHERE id=:id and user_id=:user_id');
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
		$stmt->execute();
	}
}