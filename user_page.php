<?php

session_start();

include 'functions/db.php';
include 'functions/http.php';
include 'functions/posts.php';
include 'functions/users.php';
include 'functions/pagination.php';

if(!isset($_SESSION['user_id'])) {
	redirect('/login_form.php');
}

$dbh = connect();

$user = selectUserById($dbh, $_GET['user_id']);
$name = $user['name'];

$page = $_GET['page'] ?? null;
$posts = selectUserPosts($dbh, $page, $_GET['user_id']);

$total_posts = countUserPosts($dbh, $_GET['user_id']);
$pages = countPages($total_posts);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>掲示板</title>
</head>
<body>
<h1>掲示板</h1>
<p><?php echo $name; ?>さんの投稿一覧</p>
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
				<td><?php echo $post['id']; ?></td>
				<td><?php echo $post['name']; ?></td>
				<td><?php echo nl2br(htmlspecialchars($post['post'])); ?></td>
				<?php if($post['user_id'] === $_SESSION['user_id']) : ?>
					<td>
						<form action="delete.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
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
		<a href="?user_id=<?php echo $_GET['user_id']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
	<?php endfor; ?>
</div>
</body>
</html>