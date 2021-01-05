ReactDOM.render(
	<div>
		<h1>ログイン</h1>
		<div id="login-form">
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
			</form>
		</div>
		<a href="/register_form">新規登録はコチラ</a>
	</div>,
	document.getElementById('root')
);
