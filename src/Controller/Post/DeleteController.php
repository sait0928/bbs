<?php
namespace Controller\Post;

use CsrfToken\CsrfToken;
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
	private CsrfToken $csrf_token;
	private PostWriter $post_writer;

	public function __construct(
		Session $session,
		Http $http,
		CsrfToken $csrf_token,
		PostWriter $post_writer
	) {
		$this->session = $session;
		$this->http = $http;
		$this->csrf_token = $csrf_token;
		$this->post_writer = $post_writer;
	}

	/**
	 * POST通信で送られてきたposts.idを元に
	 * postsのレコードを削除する
	 */
	public function deleteAction(): void
	{
		$user_id = $this->session->get('user_id');

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/user_page?user_id='.$user_id);
		}

		$csrf_token = $this->csrf_token->get();
		if($csrf_token !== $_POST['csrf_token'])
		{
			$this->http->redirect('/login_form');
		}

		$this->post_writer->delete($_POST['id'], $user_id);

		$this->http->redirect('/user_page?user_id='.$user_id);
	}
}
