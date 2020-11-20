<?php

use Model\User\SelectUser;
use Model\User\UserRegistration;
use Model\User\Auth;

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

	$user_registration = new UserRegistration();
	$user_registration->register($_POST['name'], $_POST['email'], $_POST['pass']);

	$auth = new Auth(
		new SelectUser()
	);
	$auth->login($_POST['email'], $_POST['pass']);

	if (!$auth->isLoggedIn()) {
		redirect('/register_form');
	}

	redirect('/');
}
