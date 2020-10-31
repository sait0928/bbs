<?php

session_start();

include 'functions/http.php';

if(isset($_SESSION['user_id'])) {
	redirect('/');
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>掲示板</title>
</head>
<body>
<h1>ログイン</h1>
<div id="form">
	<form action="login.php" method="POST">
		<label for="email">メールアドレス:</label>
		<input type="email" name="email" id="email"><br>
		<label for="pass">パスワード:</label>
		<input type="password" name="pass" id="pass"><br>
		<input type="submit" value="ログイン">
	</form>
</div>
<div id="register">
	<a href="register_form.php">新規登録はコチラ</a>
</div>
</body>
</html>