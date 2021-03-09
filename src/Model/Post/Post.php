<?php
namespace Model\Post;

/**
 * 記事のモデル
 *
 * @package Model\Post
 */
class Post implements \JsonSerializable
{
	private int $post_id;
	private string $post;
	private int $user_id;
	private string $name;

	public function __construct(
		int $post_id,
		string $post,
		int $user_id,
		string $name
	) {
		$this->post_id = $post_id;
		$this->post = $post;
		$this->user_id = $user_id;
		$this->name = $name;
	}

	public function jsonSerialize()
	{
		return [
			'post_id' => $this->post_id,
			'post'    => $this->post,
			'user_id' => $this->user_id,
			'name'    => $this->name,
		];
	}

	/**
	 * post_id 取得
	 *
	 * @return int
	 */
	public function getPostId(): int
	{
		return $this->post_id;
	}

	/**
	 * post 取得
	 *
	 * @return string
	 */
	public function getPost(): string
	{
		return $this->post;
	}

	/**
	 * user_id 取得
	 *
	 * @return int
	 */
	public function getUserId(): int
	{
		return $this->user_id;
	}

	/**
	 * user_name 取得
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}
