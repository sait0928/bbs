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

	/**
	 * 記事のid を set
	 *
	 * @param int $post_id
	 */
	public function setPostId(int $post_id): void
	{
		$this->post_id = $post_id;
	}

	/**
	 * 記事の内容を set
	 *
	 * @param string $post
	 */
	public function setPost(string $post): void
	{
		$this->post = $post;
	}

	/**
	 * 記事を書いたユーザーの id を set
	 *
	 * @param int $user_id
	 */
	public function setUserId(int $user_id): void
	{
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
