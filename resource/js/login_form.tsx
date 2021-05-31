import {Link} from "react-router-dom";
import * as React from "react";

export const LoginForm = () => {
	const app = document.getElementById('app');
	const params = JSON.parse(app.dataset.params);
	return (
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
					<input type="hidden" name="csrf_token" value={params.csrf_token} />
					<input type="submit" value="ログイン" />
				</form>
			</div>
			<Link to="/register_form">新規登録はコチラ</Link>
		</div>
	);
}