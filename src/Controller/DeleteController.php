<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Model\Post\PostWriter;
use Model\User\Auth;
use Model\User\SelectUser;

/**
 * '/delete' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class DeleteController
{
	private Http $http;
	private Auth $auth;
	private PostWriter $post_writer;

	public function __construct(
		Http $http,
		Auth $auth,
		PostWriter $post_writer
	) {
		$this->http = $http;
		$this->auth = $auth;
		$this->post_writer = $post_writer;
	}

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Http(),
			new Auth(new SelectUser($database)),
			new PostWriter($database)
		);
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

		if(!$this->auth->isLoggedIn()) {
			$this->http->redirect('/login_form');
		}

		$this->post_writer->delete($_POST['id'], $_SESSION['user_id']);

		$this->http->redirect('/user_page?user_id='.$_SESSION['user_id']);
	}
}
