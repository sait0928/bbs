<?php
namespace Controller;

use Http\Http;
use Model\User\SelectUser;
use Model\Post\PostReader;
use Model\Post\PostCounter;
use Pagination\Pagination;
use View\View;

/**
 * '/' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class IndexController
{
	private Http $http;
	private SelectUser $select_user;
	private PostReader $post_reader;
	private PostCounter $post_counter;
	private Pagination $pagination;
	private View $view;

	public function __construct(
		Http $http,
		SelectUser $select_user,
		PostReader $post_reader,
		PostCounter $post_counter,
		Pagination $pagination,
		View $view
	) {
		$this->http = $http;
		$this->select_user = $select_user;
		$this->post_reader = $post_reader;
		$this->post_counter = $post_counter;
		$this->pagination = $pagination;
		$this->view = $view;
	}

	/**
	 * 現在ログインしているユーザーと
	 * 記事一覧を表示
	 */
	public function indexAction(): void
	{
		$user = $this->select_user->selectUserById($_SESSION['user_id']);
		$name = $user->getUserName();

		$page = $_GET['page'] ?? 1;
		$posts = $this->post_reader->select($page);

		$total_posts = $this->post_counter->countPosts();
		$pages = $this->pagination->countPages($total_posts);

		$params = [
			'name' => $name,
			'posts' => $posts,
			'pages' => $pages,
		];
		$this->view->render('/index.php', $params);
	}
}
