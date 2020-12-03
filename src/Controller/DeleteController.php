<?php
namespace Controller;

use Http\Http;
use Http\Session;
use Model\Post\PostWriter;

/**
 * '/delete' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class DeleteController
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
		return new self(
			new Session(),
			new Http(),
			new PostWriter()
		);
	}

	/**
	 * POST通信で送られてきたposts.idを元に
	 * postsのレコードを削除する
	 */
	public function deleteAction(): void
	{
		$this->session->start();

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/user_page?user_id='.$_SESSION['user_id']);
		}

		$this->post_writer->delete($_POST['id']);

		$this->http->redirect('/user_page?user_id='.$_SESSION['user_id']);
	}
}
