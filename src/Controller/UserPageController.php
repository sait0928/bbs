<?php
namespace Controller;

use Database\Database;
use Http\Http;
use Model\User\Auth;
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
	private Auth $auth;
	private Http $http;
	private SelectUser $select_user;
	private PostReader $post_reader;
	private PostCounter $post_counter;
	private Pagination $pagination;
	private View $view;

	public function __construct(
		Auth $auth,
		Http $http,
		SelectUser $select_user,
		PostReader $post_reader,
		PostCounter $post_counter,
		Pagination $pagination,
		View $view
	) {
		$this->auth = $auth;
		$this->http = $http;
		$this->select_user = $select_user;
		$this->post_reader = $post_reader;
		$this->post_counter = $post_counter;
		$this->pagination = $pagination;
		$this->view = $view;
	}

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Auth(new SelectUser($database)),
			new Http(),
			new SelectUser($database),
			new PostReader($database),
			new PostCounter($database),
			new Pagination(),
			new View()
		);
	}

	/**
	 * GET通信で取得したuser_idを元に
	 * そのユーザーが投稿した記事一覧を表示
	 */
	public function userPageAction(): void
	{
		if (!$this->auth->isLoggedIn()) {
			$this->http->redirect('/login_form');
		}

		$user = $this->select_user->selectUserById($_GET['user_id']);
		$name = $user->getUserName();

		$page = $_GET['page'] ?? 1;
		$posts = $this->post_reader->selectUserPosts($page, $_GET['user_id']);

		$total_posts = $this->post_counter->countUserPosts($_GET['user_id']);
		$pages = $this->pagination->countPages($total_posts);

		$params = [
			'name' => $name,
			'posts' => $posts,
			'pages' => $pages,
		];
		$this->view->render('/user_page.php', $params);

	}
}
