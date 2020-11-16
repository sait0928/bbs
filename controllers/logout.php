<?php

use Model\User\Auth;

include '../Model/User/Auth.php';
include '../functions/http.php';
include '../functions/db.php';

function logoutAction(): void
{
	session_start();

	$auth = new Auth();
	$auth->logout();

	redirect('/login_form');
}
