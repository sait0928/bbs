import React from "react";

import {
	BrowserRouter as Router,
	Switch,
	Route,
	Link
} from "react-router-dom";

export default function Default() {
	return (
		<Router>
			<div>
				<Switch>
					<Route exact path="/">
						<Home />
					</Route>
					<Route exact path="/login_form">
						<LoginForm />
					</Route>
					<Route exact path="/register_form">
						<RegisterForm />
					</Route>
					<Route exact path="/user_page">
						<UserPage />
					</Route>
					<Route exact path="/user_update_form">
						<UserUpdateForm />
					</Route>
				</Switch>
			</div>
		</Router>
	);
}

function Home() {
	return (
		<div>
			<h1>掲示板</h1>
			<p>ようこそ{params.name}さん！</p>
			<div id="user-update"><Link to="/user_update_form">ユーザ情報を更新する</Link></div>
			<div id="form">
				<form action="/insert" method="POST">
					<textarea name="text" id="" cols="50" rows="5" required />
					<input type="hidden" name="csrf_token" value={params.csrf_token} />
					<input type="submit" value="投稿" />
				</form>
			</div>
			<div id="posts">
				<table>
					<tr>
						<th>投稿ID</th>
						<th>投稿者</th>
						<th>投稿内容</th>
					</tr>
					{params.posts.map((post) => {
						return <tr>
							<td>{post.post_id}</td>
							<td><Link to={`/user_page?user_id=${post.user_id}`}>{post.name}</Link></td>
							<td>{post.post}</td>
						</tr>
					})}
				</table>
			</div>
			<div id="pagination">
				{params.page_links.map((page_link) => {
					return <Link to={`/?page=${page_link}`}>{page_link}</Link>
				})}
			</div>
			<div id="logout">
				<Link to="/logout">ログアウト</Link>
			</div>
		</div>
	);
}

function LoginForm() {
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

function RegisterForm() {
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

function UserPage() {
	return (
		<div>
			<h1>掲示板</h1>
			<p>{params.name}さんの投稿一覧</p>
			<div id="return">
				<Link to="/">←戻る</Link>
			</div>
			<div id="posts">
				<table>
					<tr>
						<th>投稿ID</th>
						<th>投稿者</th>
						<th>投稿内容</th>
					</tr>
					{params.posts.map((post) => {
						return <tr>
							<td>{post.post_id}</td>
							<td>{post.name}</td>
							<td>{post.post}</td>
							{post.user_id === params.session_user_id &&
							<td>
								<form action="/delete" method="POST">
									<input type="hidden" name="id" value={post.post_id} />
									<input type="hidden" name="csrf_token" value={params.csrf_token} />
									<input type="submit" value="削除" />
								</form>
							</td>
							}
						</tr>
					})}
				</table>
			</div>
			<div id="pagination">
				{params.page_links.map((page_link) => {
					return <Link to={`/user_page?user_id=${params.get_user_id}&page=${page_link}`}>{page_link}</Link>
				})}
			</div>
		</div>
	);
}

function UserUpdateForm() {
	return (
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
			<Link to="/">←戻る</Link>
		</div>
	);
}
