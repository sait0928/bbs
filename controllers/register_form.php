<?php

function registerFormAction()
{
	include '../functions/http.php';

	session_start();

	if(isset($_SESSION['user_id'])) {
		redirect('/');
	}

	include '../templates/register_form.php';
}
