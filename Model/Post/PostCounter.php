<?php
namespace Model\Post;

class PostCounter
{
	private \PDO $dbh;

	public function __construct()
	{
		$this->dbh = connect();
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