<?php

session_start();

include 'functions.php';
include 'functions/db.php';
include 'functions/http.php';

$dbh = connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(login($dbh, $_POST['email'], $_POST['pass'])) {
		$user = selectUserByEmail($dbh, $_POST['email']);

		$_SESSION['user_id'] = $user['id'];

		redirect('/');
	} else {
		redirect('/login_form.php');
	}
}
