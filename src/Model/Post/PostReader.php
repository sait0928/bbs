<?php
namespace Model\Post;

use Database\Database;
use Pagination\Pagination;

/**
 * 記事を読み込むモデル
 *
 * @package Model\Post
 */
class PostReader
{
	private Database $db;
	private Pagination $pagination;

	public function __construct(
		Database $db,
		Pagination $pagination
	) {
		$this->db = $db;
		$this->pagination = $pagination;
	}

	/**
	 * 投稿一覧ページで現在のページ番号に対応する記事を取得
	 *
	 * @param int $page
	 * @return array
	 */
	public function select(int $page): array
	{
		$display_posts = $this->pagination::DISPLAY_POSTS;
		$start = ($page - 1) * $display_posts;
		$stmt = $this->db->getConnection()->prepare('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC LIMIT :start, :display_posts');
		$stmt->bindParam(':start', $start, \PDO::PARAM_INT);
		$stmt->bindParam(':display_posts', $display_posts, \PDO::PARAM_INT);
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
		$display_posts = $this->pagination::DISPLAY_POSTS;
		$start = ($page - 1) * $display_posts;
		$stmt = $this->db->getConnection()->prepare('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE user_id = :user_id ORDER BY posts.id DESC LIMIT :start, :display_posts');
		$stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
		$stmt->bindParam(':start', $start, \PDO::PARAM_INT);
		$stmt->bindParam(':display_posts', $display_posts, \PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}