<?php

session_start();

if(isset($_SESSION['name'])) {
	header('Location: /');
	exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>掲示板</title>
</head>
<body>
<h1>新規登録</h1>
<div id="form">
	<form action="register.php" method="POST">
		<label for="name">名前:</label>
		<input type="text" name="name" id="name"><br>
		<label for="pass">パスワード設定:</label>
		<input type="password" name="pass" id="pass"><br>
		<label for="again">パスワード再入力:</label>
		<input type="password" name="again" id="again"><br>
		<input type="submit" value="新規登録">
	</form>
</div>
<div id="login">
	<a href="login_form.php">ログインはコチラ</a>
</div>
</body>
</html>