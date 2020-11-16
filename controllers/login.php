<?php

use Model\User\Auth;
use Model\User\SelectUser;
use Model\User\User;

include '../functions/db.php';
include '../functions/http.php';

function loginAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/login_form');
	}

	$user = new User();
	$user->setEmail($_POST['email']);
	$user->setPassword($_POST['pass']);

	$auth = new Auth();
	$select_user = new SelectUser();
	if($auth->login($user)) {
		$login_user = $select_user->selectUserByEmail($user);
		$_SESSION['user_id'] = $login_user['id'];

		redirect('/');
	} else {
		redirect('/login_form');
	}
}
