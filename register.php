<?php

session_start();

include 'functions.php';

$dbh = connect('mysql:dbname=bbs;host=localhost', 'root', '');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	register($_POST['pass'], $_POST['again'], $dbh, $_POST['name'], $_POST['email']);

	$user = selectUserByEmail($dbh, $_POST['email']);

	$_SESSION['user_id'] = $user['id'];

	redirect('/');
}
