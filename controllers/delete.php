<?php

include '../functions/db.php';
include '../functions/posts.php';
include '../functions/http.php';

function deleteAction(): void
{
	session_start();

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		redirect('/user_page?user_id='.$_SESSION['user_id']);
	}

	$dbh = connect();

	delete($dbh, $_POST['id']);

	redirect('/user_page?user_id='.$_SESSION['user_id']);
}
