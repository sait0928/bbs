<?php

include 'functions/db.php';

$dbh = connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	delete($dbh, $_POST['id']);
}

redirect('/');
