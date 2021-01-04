<?php
namespace Controller;

use Http\Session;
use Model\User\SelectUser;
use Model\Post\PostReader;
use Model\Post\PostCounter;
use Pagination\Pagination;
use View\ReactView;

/**
 * '/' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class IndexController
{
	private Session $session;
	private SelectUser $select_user;
	private PostReader $post_reader;
	private PostCounter $post_counter;
	private Pagination $pagination;
	private ReactView $react_view;

	public function __construct(
		Session $session,
		SelectUser $select_user,
		PostReader $post_reader,
		PostCounter $post_counter,
		Pagination $pagination,
		ReactView $react_view
	) {
		$this->session = $session;
		$this->select_user = $select_user;
		$this->post_reader = $post_reader;
		$this->post_counter = $post_counter;
		$this->pagination = $pagination;
		$this->react_view = $react_view;
	}

	/**
	 * 現在ログインしているユーザーと
	 * 記事一覧を表示
	 */
	public function indexAction(): void
	{
		$user_id = $this->session->get('user_id');

		$user = $this->select_user->selectUserById($user_id);
		$name = $user->getUserName();

		$current_page = $_GET['page'] ?? 1;
		$posts = $this->post_reader->select($current_page);

		$total_posts = $this->post_counter->countPosts();
		$total_pages = $this->pagination->countPages($total_posts);
		$page_links = $this->pagination->createPageLinksArray($current_page, $total_pages);

		$params = [
			'name' => $name,
			'posts' => $posts,
			'page_links' => $page_links,
		];
		$this->react_view->render('/index.php', $params);
	}
}
