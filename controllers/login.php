<?php

include '../functions/db.php';
include '../functions/http.php';
include '../functions/users.php';
include '../functions/auth.php';

function loginAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/login_form');
	}

	$dbh = connect();

	if(login($dbh, $_POST['email'], $_POST['pass'])) {
		$user = selectUserByEmail($dbh, $_POST['email']);

		$_SESSION['user_id'] = $user['id'];

		redirect('/');
	} else {
		redirect('/login_form');
	}
}

loginAction();
