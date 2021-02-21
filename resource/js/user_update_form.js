const root = document.getElementById('root');
const params = JSON.parse(root.dataset.params);

ReactDOM.render(
	<div>
		<h1>ユーザ情報更新</h1>
		<div id="user-update-form">
			<form action="/user_update" method="POST">
				<p>変更したい項目のみ入力してください</p>
				ユーザ名を変更:
				<input type="text" name="name" id="name" /><br />
				メールアドレスを変更:
				<input type="email" name="email" id="email" /><br />
				パスワードを変更:
				<input type="password" name="pass" id="pass" /><br />
				変更後パスワード再入力:
				<input type="password" name="again" id="again" /><br />
				<input type="hidden" name="csrf_token" value={params.csrf_token} />
				<input type="submit" value="更新" />
			</form>
		</div>
		<a href="/">←戻る</a>
	</div>,
	root
);