<?php

use Model\User\Auth;
use Model\User\SelectUser;

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
