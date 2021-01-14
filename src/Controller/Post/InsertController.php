<?php
namespace Controller\Post;

use CsrfToken\CsrfToken;
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
	 * POST通信で送られてきたテキストと
	 * ログインユーザーのIDを
	 * postsに挿入する
	 */
	public function insertAction(): void
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/');
		}

		$csrf_token = $this->csrf_token->get();
		if($csrf_token !== $_POST['csrf_token'])
		{
			$this->http->redirect('/login_form');
		}

		$user_id = $this->session->get('user_id');

		$this->post_writer->insert($_POST['text'], $user_id);

		$this->http->redirect('/');
	}
}
