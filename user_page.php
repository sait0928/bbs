<?php

session_start();

include 'functions/db.php';
include 'functions/http.php';
include 'functions/posts.php';
include 'functions/users.php';
include 'functions/pagination.php';

if(!isset($_SESSION['user_id'])) {
	redirect('/login_form.php');
}

$dbh = connect();

$user = selectUserById($dbh, $_GET['user_id']);
$name = $user['name'];

$page = $_GET['page'] ?? null;
$posts = selectUserPosts($dbh, $page, $_GET['user_id']);

$total_posts = countUserPosts($dbh, $_GET['user_id']);
$pages = countPages($total_posts);

include 'templates/user_page.php';
