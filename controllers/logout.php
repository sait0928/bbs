<?php

function logoutAction()
{
	include '../functions/http.php';
	include '../functions/auth.php';

	session_start();

	logout();

	redirect('/login_form');
}
