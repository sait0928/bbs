<?php

use Http\Http;
use Model\User\Auth;
use Model\User\SelectUser;

function logoutAction(): void
{
	session_start();

	$auth = new Auth(
		new SelectUser()
	);
	$auth->logout();

	$http = new Http();
	$http->redirect('/login_form');
}
