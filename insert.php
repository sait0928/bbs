<?php

include 'connect.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$text = $_POST['text'];
	$stmt = $dbh->prepare('INSERT INTO posts (post) VALUES (:post)');
	$stmt->bindParam(':post', $text, PDO::PARAM_STR);
	$stmt->execute();
}

header('Location: /');
