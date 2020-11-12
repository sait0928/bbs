<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>掲示板</title>
</head>
<body>
<h1>ログイン</h1>
<div id="form">
	<form action="/login" method="POST">
		<label for="email">メールアドレス:</label>
		<input type="email" name="email" id="email" required><br>
		<label for="pass">パスワード:</label>
		<input type="password" name="pass" id="pass" required><br>
		<input type="submit" value="ログイン">
	</form>
</div>
<div id="register">
	<a href="/register_form">新規登録はコチラ</a>
</div>
</body>
</html>