ReactDOM.render(
	<h1>新規登録</h1>,
	document.getElementById('title')
);

ReactDOM.render(
	<form action="/register" method="POST">
		<label htmlFor="name">
			名前:
			<input type="text" name="name" id="name" required />
		</label><br />
		<label htmlFor="email">
			メールアドレス:
			<input type="email" name="email" id="email" required />
		</label><br />
		<label htmlFor="pass">
			パスワード設定:
			<input type="password" name="pass" id="pass" required />
		</label><br />
		<label htmlFor="again">
			パスワード再入力:
			<input type="password" name="again" id="again" required />
		</label><br />
		<input type="submit" value="新規登録" />
	</form>,
	document.getElementById('register-form')
);

ReactDOM.render(
	<a href="/login_form">ログインはコチラ</a>,
	document.getElementById('login-form-link')
);