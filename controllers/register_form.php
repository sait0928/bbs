<?php

include '../functions/http.php';

function registerFormAction(): void
{
	session_start();

	if(isset($_SESSION['user_id'])) {
		redirect('/');
	}

	include '../templates/register_form.php';
}
