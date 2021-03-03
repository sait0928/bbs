<?php
namespace Controller;

use Http\CsrfToken;
use Http\Session;
use Http\Validator;
use Model\User\SelectUser;
use Model\Post\PostReader;
use Model\Post\PostCounter;
use Pagination\Pagination;
use View\ReactView;

/**
 * '/user_page' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class UserPageController
{
	private Session $session;
	private Validator $validator;
	private SelectUser $select_user;
	private PostReader $post_reader;
	private PostCounter $post_counter;
	private Pagination $pagination;
	private CsrfToken $csrf_token;
	private ReactView $react_view;

	public function __construct(
		Session $session,
		Validator $validator,
		SelectUser $select_user,
		PostReader $post_reader,
		PostCounter $post_counter,
		Pagination $pagination,
		CsrfToken $csrf_token,
		ReactView $react_view
	) {
		$this->session = $session;
		$this->validator = $validator;
		$this->select_user = $select_user;
		$this->post_reader = $post_reader;
		$this->post_counter = $post_counter;
		$this->pagination = $pagination;
		$this->csrf_token = $csrf_token;
		$this->react_view = $react_view;
	}

	/**
	 * GET通信で取得したuser_idを元に
	 * そのユーザーが投稿した記事一覧を表示
	 */
	public function userPageAction(): void
	{
		$session_user_id = $this->session->get('user_id');
		$this->validator->validateInt($session_user_id, '/logout');

		$get_user_id = $_GET['user_id'];
		$this->validator->validateInt($get_user_id, '/');

		$user = $this->select_user->selectUserById($get_user_id);
		$name = $user->getUserName();

		$current_page = $_GET['page'] ?? 1;
		$posts = $this->post_reader->selectUserPosts($current_page, $get_user_id);

		$total_posts = $this->post_counter->countUserPosts($get_user_id);
		$total_pages = $this->pagination->countPages($total_posts);
		$page_links = $this->pagination->createPageLinksArray($current_page, $total_pages);

		$csrf_token = $this->csrf_token->get();

		$params = [
			'session_user_id' => $session_user_id,
			'name'            => $name,
			'posts'           => $posts,
			'page_links'      => $page_links,
			'get_user_id'     => $get_user_id,
			'csrf_token'      => $csrf_token,
		];
		$this->react_view->render('/user_page.php', $params);
	}
}
