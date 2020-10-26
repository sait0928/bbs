<?php

session_start();

include 'functions.php';

$dbh = connect('mysql:dbname=bbs;host=localhost', 'root', '');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['name'];

	$stmt = $dbh->prepare('SELECT pass FROM users WHERE user=:name');
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->execute();

	$pass = $stmt->fetch();

	if(password_verify($_POST['pass'], $pass['pass'])) {
		$_SESSION['name'] = $name;

		header('Location: /');
	} else {
		header('Location: /login_form.php');
	}
}
