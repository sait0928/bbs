<?php

function insertAction()
{
	include '../functions/db.php';
	include '../functions/http.php';
	include '../functions/posts.php';

	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/');
	}

	$dbh = connect();

	insert($dbh, $_POST['text'], $_POST['user_id']);

	redirect('/');
}
