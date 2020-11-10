<?php

session_start();

include 'functions/db.php';
include 'functions/http.php';
include 'functions/users.php';
include 'functions/auth.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
	redirect('/login_form.php');
}

$dbh = connect();

if(login($dbh, $_POST['email'], $_POST['pass'])) {
	$user = selectUserByEmail($dbh, $_POST['email']);

	$_SESSION['user_id'] = $user['id'];

	redirect('/');
} else {
	redirect('/login_form.php');
}
