<?php

use Model\User\SelectUser;
use Model\Post\PostReader;

include '../functions/db.php';
include '../functions/http.php';
include '../functions/posts.php';
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

	$dbh = connect();
	$total_posts = countPosts($dbh);
	$pages = countPages($total_posts);

	include '../templates/index.php';
}
