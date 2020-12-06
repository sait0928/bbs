<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Http\Session;
use Model\Post\PostWriter;

/**
 * '/insert' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class InsertController
{
	private Session $session;
	private Http $http;
	private PostWriter $post_writer;

	public function __construct(
		Session $session,
		Http $http,
		PostWriter $post_writer
	) {
		$this->session = $session;
		$this->http = $http;
		$this->post_writer = $post_writer;
	}

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Session(),
			new Http(),
			new PostWriter($database)
		);
	}

	/**
	 * POST通信で送られてきたテキストと
	 * ログインユーザーのIDを
	 * postsに挿入する
	 */
	public function insertAction(): void
	{
		$this->session->start();

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/');
		}

		$this->post_writer->insert($_POST['text'], $_SESSION['user_id']);

		$this->http->redirect('/');
	}
}
