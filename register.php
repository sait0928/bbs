<?php

session_start();

include 'functions.php';

$dbh = connect('mysql:dbname=bbs;host=localhost', 'root', '');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['name'];
	$pass = $_POST['pass'];
	$again = $_POST['again'];
	if($pass === $again) {
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		$stmt = $dbh->prepare('INSERT INTO users (user, pass) VALUES (:user, :pass)');
		$stmt->bindParam(':user', $name, PDO::PARAM_STR);
		$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
		$stmt->execute();
	}

	$_SESSION['name'] = $name;

	redirect('/');
}
