<?php

session_start();

include 'functions.php';

if(!isset($_SESSION['user_id'])) {
	redirect('/login_form.php');
} else {
	$dbh = connect('mysql:dbname=bbs;host=localhost', 'root', '');

	$user = selectUserById($dbh, $_SESSION['user_id']);

	$name = $user['name'];
}

$page = $_GET['page'] ?? null;

$posts = select($dbh, $page);

$pages = countPages($dbh);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>掲示板</title>
</head>
<body>
<h1>掲示板</h1>
<p>ようこそ<?php echo $name; ?>さん！</p>
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
<div id="logout">
	<a href="logout.php">ログアウト</a>
</div>
</body>
</html>