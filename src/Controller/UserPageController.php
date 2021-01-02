<?php
namespace Controller;

use Http\Session;
use Model\User\SelectUser;
use Model\Post\PostReader;
use Model\Post\PostCounter;
use Pagination\Pagination;
use View\View;

/**
 * '/user_page' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class UserPageController
{
	private Session $session;
	private SelectUser $select_user;
	private PostReader $post_reader;
	private PostCounter $post_counter;
	private Pagination $pagination;
	private View $view;

	public function __construct(
		Session $session,
		SelectUser $select_user,
		PostReader $post_reader,
		PostCounter $post_counter,
		Pagination $pagination,
		View $view
	) {
		$this->session = $session;
		$this->select_user = $select_user;
		$this->post_reader = $post_reader;
		$this->post_counter = $post_counter;
		$this->pagination = $pagination;
		$this->view = $view;
	}

	/**
	 * GET通信で取得したuser_idを元に
	 * そのユーザーが投稿した記事一覧を表示
	 */
	public function userPageAction(): void
	{
		$session_user_id = $this->session->get('user_id');

		$user = $this->select_user->selectUserById($_GET['user_id']);
		$name = $user->getUserName();

		$page = $_GET['page'] ?? 1;
		$posts = $this->post_reader->selectUserPosts($page, $_GET['user_id']);

		$total_posts = $this->post_counter->countUserPosts($_GET['user_id']);
		$pages = $this->pagination->countPages($total_posts);

		$get_user_id = $_GET['user_id'];

		$params = [
			'session_user_id' => $session_user_id,
			'name'            => $name,
			'posts'           => $posts,
			'pages'           => $pages,
			'get_user_id'     => $get_user_id,
		];
		$this->view->render('/user_page.php', $params);

	}
}
