<?php

include 'functions.php';

$dbh = connect('mysql:dbname=bbs;host=localhost', 'root', '');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	insert($dbh, $_POST['text'], $_POST['user_id']);
}

redirect('/');
