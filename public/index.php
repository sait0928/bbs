<?php
ini_set('display_errors', "On");
session_start();

include '../functions/db.php';
include '../functions/http.php';
include '../functions/posts.php';
include '../functions/users.php';
include '../functions/pagination.php';

if(!isset($_SESSION['user_id'])) {
	redirect('/login_form.php');
}

$dbh = connect();

$user = selectUserById($dbh, $_SESSION['user_id']);
$name = $user['name'];

$page = $_GET['page'] ?? null;
$posts = select($dbh, $page);

$total_posts = countPosts($dbh);
$pages = countPages($total_posts);

include '../templates/index.php';
