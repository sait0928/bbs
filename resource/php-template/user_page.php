<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>掲示板</title>
</head>
<body>
<h1>掲示板</h1>
<p><?php echo htmlspecialchars($name); ?>さんの投稿一覧</p>
<div id="return">
	<a href="/">←戻る</a>
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
				<td><?php echo htmlspecialchars($post['name']); ?></td>
				<td><?php echo nl2br(htmlspecialchars($post['post'])); ?></td>
				<?php if($post['user_id'] === $session_user_id) : ?>
					<td>
						<form action="/delete" method="POST">
							<input type="hidden" name="id" value="<?php echo $post['post_id']; ?>">
							<input type="submit" value="削除">
						</form>
					</td>
				<?php endif; ?>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<div id="pagination">
	<?php for($i = 1; $i <= $pages; $i++) : ?>
		<a href="/user_page?user_id=<?php echo $get_user_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
	<?php endfor; ?>
</div>
</body>
</html>