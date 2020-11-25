<?php
namespace Controller;

use Http\Http;
use Model\User\SelectUser;
use Model\Post\PostReader;
use Model\Post\PostCounter;
use Pagination\Pagination;
use View\View;

class UserPageController
{
	public function userPageAction(): void
	{
		session_start();

		if (!isset($_SESSION['user_id'])) {
			$http = new Http();
			$http->redirect('/login_form');
		}

		$select_user = new SelectUser();
		$user = $select_user->selectUserById($_GET['user_id']);
		$name = $user->getUserName();

		$page = $_GET['page'] ?? null;
		$post_reader = new PostReader();
		$posts = $post_reader->selectUserPosts($page, $_GET['user_id']);

		$post_counter = new PostCounter();
		$total_posts = $post_counter->countUserPosts($_GET['user_id']);
		$pagination = new Pagination();
		$pages = $pagination->countPages($total_posts);

		$params = [
			'name' => $name,
			'posts' => $posts,
			'pages' => $pages,
		];
		$view = new View();
		$view->render('/user_page.php', $params);

	}
}
