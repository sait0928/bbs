<?php
namespace Controller;

use Http\Http;

class RegisterFormController
{
	public function registerFormAction(): void
	{
		session_start();

		if(isset($_SESSION['user_id'])) {
			$http = new Http();
			$http->redirect('/');
		}

		include '../templates/register_form.php';
	}
}
