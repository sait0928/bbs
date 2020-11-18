<?php

use Model\User\Auth;
use Model\User\SelectUser;
use Model\User\User;

include '../Model/User/Auth.php';
include '../Model/User/SelectUser.php';
include '../Model/User/User.php';
include '../functions/db.php';
include '../functions/http.php';

function loginAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/login_form');
	}

	$auth = new Auth(
		new SelectUser()
	);
	$auth->login($_POST['email'], $_POST['pass']);

	if (!$auth->isLoggedIn()) {
		redirect('/login_form');
	}

	redirect('/');
}
