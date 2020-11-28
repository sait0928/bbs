<?php
namespace Model\Post;

use Database\Database;

/**
 * 記事の総数をカウントするモデル
 *
 * @package Model\Post
 */
class PostCounter
{
	private \PDO $dbh;

	public function __construct()
	{
		$database = new Database();
		$this->dbh = $database->connect();
	}

	/**
	 * 記事の総数をカウント
	 *
	 * @return int
	 */
	public function countPosts(): int
	{
		$stmt = $this->dbh->query('SELECT COUNT(*) FROM posts');
		return $stmt->fetchColumn();
	}

	/**
	 * 特定のユーザーが投稿した記事の総数をカウント
	 *
	 * @param int $user_id
	 * @return int
	 */
	public function countUserPosts(int $user_id): int
	{
		$stmt = $this->dbh->prepare('SELECT COUNT(*) FROM posts WHERE user_id = :user_id');
		$stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
}