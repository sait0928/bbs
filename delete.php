<?php

session_start();

include 'functions/db.php';
include 'functions/posts.php';
include 'functions/http.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
	redirect('user_page.php?user_id='.$_SESSION['user_id']);
}

$dbh = connect();

delete($dbh, $_POST['id']);

redirect('user_page.php?user_id='.$_SESSION['user_id']);
