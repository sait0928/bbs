<?php

include 'functions/db.php';
include 'functions/posts.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
	redirect('/');
}

$dbh = connect();

delete($dbh, $_POST['id']);

redirect('/');
