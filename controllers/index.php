<?php

use Model\User\SelectUser;
use Model\User\User;

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

	$dbh = connect();

	$page = $_GET['page'] ?? null;
	$posts = select($dbh, $page);

	$total_posts = countPosts($dbh);
	$pages = countPages($total_posts);

	include '../templates/index.php';
}
