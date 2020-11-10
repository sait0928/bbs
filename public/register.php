<?php

session_start();

include '../functions/db.php';
include '../functions/http.php';
include '../functions/users.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
	redirect('/register_form.php');
}

if($_POST['pass'] !== $_POST['again']) {
	redirect('/register_form.php');
}

$dbh = connect();

register($_POST['pass'], $dbh, $_POST['name'], $_POST['email']);

$user = selectUserByEmail($dbh, $_POST['email']);

$_SESSION['user_id'] = $user['id'];

redirect('/');
