import {Link} from "react-router-dom";
import React from "react";

export const RegisterForm = () => {
	return (
		<div>
			<h1>新規登録</h1>
			<div id="register-form">
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
					<input type="hidden" name="csrf_token" value={params.csrf_token} />
					<input type="submit" value="新規登録" />
				</form>
			</div>
			<Link to="/login_form">ログインはコチラ</Link>
		</div>
	);
}