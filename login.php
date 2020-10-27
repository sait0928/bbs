<?php

session_start();

include 'functions.php';

$dbh = connect('mysql:dbname=bbs;host=localhost', 'root', '');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(login($dbh, $_POST['name'], $_POST['pass'])) {
		$_SESSION['name'] = $_POST['name'];

		redirect('/');
	} else {
		redirect('/login_form.php');
	}
}
