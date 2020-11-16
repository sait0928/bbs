<?php

include '../functions/db.php';
include '../functions/http.php';
include '../functions/posts.php';

function insertAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/');
	}

	$dbh = connect();

	insert($dbh, $_POST['text'], $_POST['user_id']);

	redirect('/');
}