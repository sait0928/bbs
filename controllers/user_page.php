<?php

use Model\User\SelectUser;
use Model\User\User;

include '../functions/db.php';
include '../functions/http.php';
include '../functions/posts.php';
include '../functions/pagination.php';

function userPageAction(): void
{
	session_start();

	if(!isset($_SESSION['user_id'])) {
		redirect('/login_form');
	}

	$user = new User();
	$user->setUserId($_SESSION['user_id']);

	$select_user = new SelectUser();
	$login_user = $select_user->selectUserById($user);
	$name = $login_user['name'];

	$dbh = connect();

	$page = $_GET['page'] ?? null;
	$posts = selectUserPosts($dbh, $page, $_GET['user_id']);

	$total_posts = countUserPosts($dbh, $_GET['user_id']);
	$pages = countPages($total_posts);

	include '../templates/user_page.php';
}
