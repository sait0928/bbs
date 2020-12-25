<?php
namespace Controller\Post;

use Http\Http;
use Model\Post\PostWriter;

/**
 * '/delete' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class DeleteController
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
	 * POST通信で送られてきたposts.idを元に
	 * postsのレコードを削除する
	 */
	public function deleteAction(): void
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/user_page?user_id='.$_SESSION['user_id']);
		}

		$this->post_writer->delete($_POST['id'], $_SESSION['user_id']);

		$this->http->redirect('/user_page?user_id='.$_SESSION['user_id']);
	}
}
