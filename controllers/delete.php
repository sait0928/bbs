<?php

use Model\Post\PostWriter;

include '../functions/http.php';

function deleteAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/user_page?user_id='.$_SESSION['user_id']);
	}

	$post_writer = new PostWriter();
	$post_writer->delete($_POST['id']);

	redirect('/user_page?user_id='.$_SESSION['user_id']);
}
