<?php

include '../functions/db.php';
include '../functions/http.php';
include '../functions/posts.php';
include '../functions/users.php';
include '../functions/pagination.php';

function indexAction(): void
{
	session_start();

	if(!isset($_SESSION['user_id'])) {
		redirect('/login_form');
	}

	$dbh = connect();

	$user = selectUserById($dbh, $_SESSION['user_id']);
	$name = $user['name'];

	$page = $_GET['page'] ?? null;
	$posts = select($dbh, $page);

	$total_posts = countPosts($dbh);
	$pages = countPages($total_posts);

	include '../templates/index.php';
}
