<?php

use Model\User\SelectUser;
use Model\Post\PostReader;
use Model\Post\PostCounter;

include '../functions/db.php';
include '../functions/http.php';
include '../functions/pagination.php';

function indexAction(): void
{
	session_start();

	if(!isset($_SESSION['user_id'])) {
		redirect('/login_form');
	}

	$select_user = new SelectUser();
	$user = $select_user->selectUserById($_SESSION['user_id']);
	$name = $user->getUserName();

	$page = $_GET['page'] ?? null;
	$post_reader = new PostReader();
	$posts = $post_reader->select($page);

	$post_counter = new PostCounter();
	$total_posts = $post_counter->countPosts();
	$pages = countPages($total_posts);

	include '../templates/index.php';
}
