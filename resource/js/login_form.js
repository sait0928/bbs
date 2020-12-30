ReactDOM.render(
	<h1>ログイン</h1>,
	document.getElementById('title')
);

ReactDOM.render(
	<form action="/login" method="POST">
		<label htmlFor="email">
			メールアドレス:
			<input type="email" name="email" id="email" required />
		</label><br />
		<label htmlFor="pass">
			パスワード:
			<input type="password" name="pass" id="pass" required />
		</label><br />
		<input type="submit" value="ログイン" />
	</form>,
	document.getElementById('login-form')
);

ReactDOM.render(
	<a href="/register_form">新規登録はコチラ</a>,
	document.getElementById('register-form-link')
);
