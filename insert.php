<?php

include 'functions.php';
include 'functions/db.php';
include 'functions/http.php';

$dbh = connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	insert($dbh, $_POST['text'], $_POST['user_id']);
}

redirect('/');
