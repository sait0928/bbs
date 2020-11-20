<?php
namespace Model\Post;

class Post
{
	private int $post_id;
	private string $post;
	private int $user_id;

	public function setPostId(int $post_id)
	{
		$this->post_id = $post_id;
	}

	public function setPost(string $post)
	{
		$this->post = $post;
	}

	public function setUserId(int $user_id)
	{
		$this->user_id = $user_id;
	}

	public function getPostId()
	{
		return $this->post_id;
	}

	public function getPost()
	{
		return $this->post;
	}

	public function getUserId()
	{
		return $this->user_id;
	}
}
