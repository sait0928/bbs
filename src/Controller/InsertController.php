<?php
namespace Controller;

use Http\Http;
use Model\Post\PostWriter;

/**
 * '/insert' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class InsertController
{
	private Http $http;
	private PostWriter $post_writer;

	public function __construct(
		Http $http,
		PostWriter $post_writer
	) {
		$this->http = $http;
		$this->post_writer = $post_writer;
	}

	/**
	 * POST通信で送られてきたテキストと
	 * ログインユーザーのIDを
	 * postsに挿入する
	 */
	public function insertAction(): void
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/');
		}

		$this->post_writer->insert($_POST['text'], $_SESSION['user_id']);

		$this->http->redirect('/');
	}
}
