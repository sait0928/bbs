<?php

include 'functions/db.php';
include 'functions/http.php';
include 'functions/posts.php';

$dbh = connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	insert($dbh, $_POST['text'], $_POST['user_id']);
}

redirect('/');
