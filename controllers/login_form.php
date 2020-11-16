<?php

function loginFormAction()
{
	include '../functions/http.php';

	session_start();

	if(isset($_SESSION['user_id'])) {
		redirect('/');
	}

	include '../templates/login_form.php';
}
