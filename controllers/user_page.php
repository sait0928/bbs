<?php

use Model\User\SelectUser;
use Model\User\User;

include '../Model/User/SelectUser.php';
include '../Model/User/User.php';
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

	$select_user = new SelectUser();
	$user = $select_user->selectUserById($_GET['user_id']);
	$name = $user->getUserName();

	$dbh = connect();

	$page = $_GET['page'] ?? null;
	$posts = selectUserPosts($dbh, $page, $_GET['user_id']);

	$total_posts = countUserPosts($dbh, $_GET['user_id']);
	$pages = countPages($total_posts);

	include '../templates/user_page.php';
}
