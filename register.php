<?php

session_start();

include 'functions.php';
include 'functions/db.php';
include 'functions/http.php';
include 'functions/users.php';

$dbh = connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	register($_POST['pass'], $_POST['again'], $dbh, $_POST['name'], $_POST['email']);

	$user = selectUserByEmail($dbh, $_POST['email']);

	$_SESSION['user_id'] = $user['id'];

	redirect('/');
}
