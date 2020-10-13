<?php

include 'connect.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id = $_POST['id'];
	$stmt = $dbh->prepare('DELETE FROM posts WHERE id=:id');
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
}

header('Location: /');
