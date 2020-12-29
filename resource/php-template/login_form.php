<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>掲示板</title>
</head>
<body>
<div id="login"></div>
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
<!-- Load React. -->
<!-- Note: when deploying, replace "development.js" with "production.min.js". -->
<script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>

<!-- Load our React component. -->
<script src="/js/login_form.js"></script>
</body>
</html>