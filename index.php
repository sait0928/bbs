<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

$dsn = 'mysql:dbname=bbs;host=localhost';
$user = 'root';
$pass = '';

try {
	$dbh = new PDO($dsn, $user, $pass);

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_POST['process'] === 'insert') {
			$text = $_POST['text'];
			$stmt = $dbh->prepare('INSERT INTO posts (post) VALUES (:post)');
			$stmt->bindParam(':post', $text, PDO::PARAM_STR);
			$stmt->execute();
		} else if($_POST['process'] === 'delete') {
			$id = $_POST['id'];
			$stmt = $dbh->prepare('DELETE FROM posts WHERE id=:id');
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
		}
	}

	$stmt = $dbh->query('SELECT * FROM posts ORDER BY id DESC');
	$posts = $stmt->fetchAll();
} catch(PDOException $e) {
	$error = $e->getMessage();
	echo $error;
}

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>掲示板</title>
	</head>
	<body>
		<h1>掲示板</h1>
		<div id="form">
			<form action="" method="POST">
				<textarea name="text" id="" cols="50" rows="5"></textarea>
				<input type="hidden" name="process" value="insert">
				<input type="submit" value="投稿">
			</form>
		</div>
		<div id="posts">
			<table>
				<tr>
					<th>投稿ID</th>
					<th>投稿内容</th>
				</tr>
				<?php foreach($posts as $post) : ?>
				<tr>
					<td><?php echo $post['id']; ?></td>
					<td><?php echo nl2br(htmlspecialchars($post['post'])); ?></td>
					<td>
						<form action="" method="POST">
							<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
							<input type="hidden" name="process" value="delete">
							<input type="submit" value="削除">
						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</body>
</html>