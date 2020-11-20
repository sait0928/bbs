<?php

use Model\Post\PostWriter;

include '../functions/db.php';
include '../functions/http.php';

function insertAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/');
	}

	$post_writer = new PostWriter();
	$post_writer->insert($_POST['text'], $_POST['user_id']);

	redirect('/');
}
