<?php
namespace Controller\Post;

use Http\CsrfToken;
use Http\Http;
use Http\Session;
use Http\Validator;
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
	private Validator $validator;
	private Http $http;
	private CsrfToken $csrf_token;
	private PostWriter $post_writer;

	public function __construct(
		Session $session,
		Validator $validator,
		Http $http,
		CsrfToken $csrf_token,
		PostWriter $post_writer
	) {
		$this->session = $session;
		$this->validator = $validator;
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
		$this->validator->validateInt($user_id,'/logout');

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->http->redirect('/user_page?user_id='.$user_id);
		}

		$csrf_token = $this->csrf_token->get();
		if($csrf_token !== $_POST['csrf_token'])
		{
			$this->http->redirect('/login_form');
		}

		$post_id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
		$this->validator->validateInt($post_id, '/user_page?user_id='.$user_id);
		$this->post_writer->delete($post_id, $user_id);

		$this->http->redirect('/user_page?user_id='.$user_id);
	}
}
