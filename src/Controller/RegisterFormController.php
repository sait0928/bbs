<?php
namespace Controller;

use Http\Http;
use View\View;

class RegisterFormController
{
	public function registerFormAction(): void
	{
		session_start();

		if(isset($_SESSION['user_id'])) {
			$http = new Http();
			$http->redirect('/');
		}

		$view = new View();
		$view->render('/register_form.php');
	}
}
