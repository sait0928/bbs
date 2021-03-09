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
	private Database $db;

	public function __construct(
		Database $db
	) {
		$this->db = $db;
	}

	/**
	 * 記事の総数をカウント
	 *
	 * @return int
	 */
	public function countPosts(): int
	{
		$stmt = $this->db->getConnection()->query('SELECT COUNT(*) FROM posts');
		$result = $stmt->fetchColumn();
		if(!is_int($result)) {
			throw new PostCounterException("failed to count posts");
		}
		return $result;
	}

	/**
	 * 特定のユーザーが投稿した記事の総数をカウント
	 *
	 * @param int $user_id
	 * @return int
	 */
	public function countUserPosts(int $user_id): int
	{
		$stmt = $this->db->getConnection()->prepare('SELECT COUNT(*) FROM posts WHERE user_id = :user_id');
		$stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(!is_int($result)) {
			throw new PostCounterException("failed to count posts");
		}
		return $result;
	}
}