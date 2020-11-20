<?php

use Http\Http;
use Model\User\SelectUser;
use Model\Post\PostReader;
use Model\Post\PostCounter;
use Pagination\Pagination;

function indexAction(): void
{
	session_start();

	if(!isset($_SESSION['user_id'])) {
		$http = new Http();
		$http->redirect('/login_form');
	}

	$select_user = new SelectUser();
	$user = $select_user->selectUserById($_SESSION['user_id']);
	$name = $user->getUserName();

	$page = $_GET['page'] ?? null;
	$post_reader = new PostReader();
	$posts = $post_reader->select($page);

	$post_counter = new PostCounter();
	$total_posts = $post_counter->countPosts();
	$pagination = new Pagination();
	$pages = $pagination->countPages($total_posts);

	include '../templates/index.php';
}
