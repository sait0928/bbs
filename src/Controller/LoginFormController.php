<?php
namespace Controller;

use Http\Http;

class LoginFormController
{
	public function loginFormAction(): void
	{
		session_start();

		if(isset($_SESSION['user_id'])) {
			$http = new Http();
			$http->redirect('/');
		}

		include '../templates/login_form.php';
	}
}