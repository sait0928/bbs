<?php

use Model\User\Auth;
use Model\User\SelectUser;

include '../Model/User/Auth.php';
include '../Model/User/SelectUser.php';
include '../functions/http.php';
include '../functions/db.php';

function logoutAction(): void
{
	session_start();

	$auth = new Auth(
		new SelectUser()
	);
	$auth->logout();

	redirect('/login_form');
}
