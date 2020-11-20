<?php
namespace Model\Post;

class PostWriter
{
	private \PDO $dbh;

	public function __construct()
	{
		$this->dbh = connect();
	}

	function insert(string $text, int $user_id): void
	{
		$stmt = $this->dbh->prepare('INSERT INTO posts (post, user_id) VALUES (:post, :user_id)');
		$stmt->bindParam(':post', $text, \PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
		$stmt->execute();
	}

	function delete(int $id): void
	{
		$stmt = $this->dbh->prepare('DELETE FROM posts WHERE id=:id');
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();
	}
}