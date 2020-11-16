<?php

include '../functions/http.php';
include '../functions/auth.php';

function logoutAction(): void
{
	session_start();

	logout();

	redirect('/login_form');
}
