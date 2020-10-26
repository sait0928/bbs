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
		<label for="name">名前:</label>
		<input type="text" name="name" id="name"><br>
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