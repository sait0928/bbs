<?php

use Http\Http;

function registerFormAction(): void
{
	session_start();

	if(isset($_SESSION['user_id'])) {
		$http = new Http();
		$http->redirect('/');
	}

	include '../templates/register_form.php';
}
