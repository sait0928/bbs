<?php

use Model\User\SelectUser;
use Model\User\User;
use Model\User\UserRegistration;

include '../functions/db.php';
include '../functions/http.php';

function registerAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/register_form');
	}

	if($_POST['pass'] !== $_POST['again']) {
		redirect('/register_form');
	}

	$user = new User();
	$user->setUserName($_POST['name']);
	$user->setEmail($_POST['email']);
	$user->setPassword($_POST['pass']);

	$user_registration = new UserRegistration();
	$user_registration->register($user);

	$select_user = new SelectUser();
	$login_user = $select_user->selectUserByEmail($user);
	$_SESSION['user_id'] = $login_user['id'];

	redirect('/');
}
