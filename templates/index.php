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
		<input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
		<input type="submit" value="投稿">
	</form>
</div>
<div id="posts">
	<table>
		<tr>
			<th>投稿ID</th>
			<th>投稿者</th>
			<th>投稿内容</th>
		</tr>
		<?php foreach($posts as $post) : ?>
			<tr>
				<td><?php echo $post['post_id']; ?></td>
				<td><a href="user_page.php?user_id=<?php echo $post['user_id']; ?>"><?php echo $post['name']; ?></a></td>
				<td><?php echo nl2br(htmlspecialchars($post['post'])); ?></td>
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