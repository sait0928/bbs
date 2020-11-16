<?php

include '../functions/http.php';

function loginFormAction(): void
{
	session_start();

	if(isset($_SESSION['user_id'])) {
		redirect('/');
	}

	include '../templates/login_form.php';
}
