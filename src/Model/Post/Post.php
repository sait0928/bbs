<?php
namespace Model\Post;

/**
 * 記事のモデル
 *
 * @package Model\Post
 */
class Post
{
	private int $post_id;
	private string $post;
	private int $user_id;

	public function __construct(
		int $post_id,
		string $post,
		int $user_id
	) {
		$this->post_id = $post_id;
		$this->post = $post;
		$this->user_id = $user_id;
	}

	/**
	 * プロパティの post_id を取得
	 *
	 * @return int
	 */
	public function getPostId(): int
	{
		return $this->post_id;
	}

	/**
	 * プロパティの post を取得
	 *
	 * @return string
	 */
	public function getPost(): string
	{
		return $this->post;
	}

	/**
	 * プロパティの user_id を取得
	 *
	 * @return int
	 */
	public function getUserId(): int
	{
		return $this->user_id;
	}
}
