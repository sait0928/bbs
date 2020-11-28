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
	/**
	 * 現在ログインしているユーザーと
	 * 記事一覧を表示
	 */
	public function indexAction(): void
	{
		session_start();

		if(!isset($_SESSION['user_id'])) {
			$http = new Http();
			$http->redirect('/login_form');
		}

		$select_user = new SelectUser();
		$user = $select_user->selectUserById($_SESSION['user_id']);
		$name = $user->getUserName();

		$page = $_GET['page'] ?? 1;
		$post_reader = new PostReader();
		$posts = $post_reader->select($page);

		$post_counter = new PostCounter();
		$total_posts = $post_counter->countPosts();
		$pagination = new Pagination();
		$pages = $pagination->countPages($total_posts);

		$params = [
			'name' => $name,
			'posts' => $posts,
			'pages' => $pages,
		];
		$view = new View();
		$view->render('/index.php', $params);
	}
}
