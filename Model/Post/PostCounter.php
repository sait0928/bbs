<?php
namespace Model\Post;

use Database\Database;

class PostCounter
{
	private \PDO $dbh;

	public function __construct()
	{
		$database = new Database();
		$this->dbh = $database->connect();
	}

	function countPosts(): int
	{
		$stmt = $this->dbh->query('SELECT COUNT(*) FROM posts');
		return $stmt->fetchColumn();
	}

	function countUserPosts(int $user_id): int
	{
		$stmt = $this->dbh->prepare('SELECT COUNT(*) FROM posts WHERE user_id = :user_id');
		$stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
}