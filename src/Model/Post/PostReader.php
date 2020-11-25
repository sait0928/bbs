<?php
namespace Model\Post;

use Database\Database;

class PostReader
{
	private \PDO $dbh;

	public function __construct()
	{
		$database = new Database();
		$this->dbh = $database->connect();
	}

	public function select(int $page): array
	{
		$start = ($page - 1) * 3;
		$stmt = $this->dbh->prepare('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC LIMIT :start, 3');
		$stmt->bindParam(':start', $start, \PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function selectUserPosts(int $page, int $user_id): array
	{
		$start = ($page - 1) * 3;
		$stmt = $this->dbh->prepare('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE user_id = :user_id ORDER BY posts.id DESC LIMIT :start, 3');
		$stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
		$stmt->bindParam(':start', $start, \PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}