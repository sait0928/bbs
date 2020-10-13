<?php

include 'connect.php';

$page = $_GET['page'];

if($page === null) {
	$stmt = $dbh->query('SELECT * FROM posts ORDER BY id DESC LIMIT 3');
	$posts = $stmt->fetchAll();
} else {
	$start = ($page - 1) * 3;
	$stmt = $dbh->prepare('SELECT * FROM posts ORDER BY id DESC LIMIT :start, 3');
	$stmt->bindValue(':start', $start, PDO::PARAM_INT);
	$stmt->execute();
	$posts = $stmt->fetchAll();
}

$stmt = $dbh->query('SELECT COUNT(*) FROM posts');
$count = $stmt->fetchColumn();
$pages = ceil($count / 3);

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
			<form action="insert.php" method="POST">
				<textarea name="text" id="" cols="50" rows="5" required></textarea>
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
						<form action="delete.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
							<input type="submit" value="削除">
						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div id="pagination">
			<?php for($i = 1; $i <= $pages; $i++) : ?>
			<a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php endfor; ?>
		</div>
	</body>
</html>