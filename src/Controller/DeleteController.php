<?php
namespace Controller;

use Http\Http;
use Model\Post\PostWriter;

class DeleteController
{
	public function deleteAction(): void
	{
		session_start();

		$http = new Http();

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$http->redirect('/user_page?user_id='.$_SESSION['user_id']);
		}

		$post_writer = new PostWriter();
		$post_writer->delete($_POST['id']);

		$http->redirect('/user_page?user_id='.$_SESSION['user_id']);
	}
}
