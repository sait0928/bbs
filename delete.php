<?php

include 'functions.php';

$dbh = connect('mysql:dbname=bbs;host=localhost', 'root', '');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	delete($dbh, $_POST['id']);
}

header('Location: /');
