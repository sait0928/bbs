<?php
namespace Controller;

use Http\Http;
use View\View;

class LoginFormController
{
	public function loginFormAction(): void
	{
		session_start();

		if(isset($_SESSION['user_id'])) {
			$http = new Http();
			$http->redirect('/');
		}

		$view = new View();
		$view->render('/login_form.php');
	}
}
