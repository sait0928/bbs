import {Link} from "react-router-dom";
import React from "react";

export const Home = () => {
	const params = JSON.parse(app.dataset.params);
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