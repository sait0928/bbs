<?php

include '../functions/db.php';
include '../functions/http.php';
include '../functions/users.php';

function registerAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/register_form');
	}

	if($_POST['pass'] !== $_POST['again']) {
		redirect('/register_form');
	}

	$dbh = connect();

	register($_POST['pass'], $dbh, $_POST['name'], $_POST['email']);

	$user = selectUserByEmail($dbh, $_POST['email']);

	$_SESSION['user_id'] = $user['id'];

	redirect('/');
}
