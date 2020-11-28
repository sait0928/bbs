<?php
namespace Model\Post;

use Database\Database;

/**
 * 記事を読み込むモデル
 *
 * @package Model\Post
 */
class PostReader
{
	private \PDO $dbh;

	public function __construct()
	{
		$database = new Database();
		$this->dbh = $database->connect();
	}

	/**
	 * 投稿一覧ページで現在のページ番号に対応する記事を取得
	 *
	 * @param int $page
	 * @return array
	 */
	public function select(int $page): array
	{
		$start = ($page - 1) * 3;
		$stmt = $this->dbh->prepare('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC LIMIT :start, 3');
		$stmt->bindParam(':start', $start, \PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/**
	 * ユーザーページで現在のページ番号に対応する記事を取得
	 *
	 * @param int $page
	 * @param int $user_id
	 * @return array
	 */
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