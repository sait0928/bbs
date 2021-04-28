import {Link} from "react-router-dom";
import React from "react";
import { useFetch } from "./hooks";

async function handleClick() {
	var form = document.getElementById("fetch-form");
	var formData = new FormData(form);
	await fetch("/insert", {
		method: "POST",
		body: formData
	})
		.then(response => response.json())
		.then(data => console.log(data));
}

export const Home = () => {
	const queryString = require('query-string');
	const parsed = queryString.parse(location.search);
	const page = parsed.page || 1;
	const [data, loading] = useFetch("/api/home?page=" + page);
	return (
		<div>
			<h1>掲示板</h1>
			{loading ? (
				"Loading..."
			) : (
				<div>
					<p>ようこそ{data.name}さん！</p>
					<div id="user-update"><Link to="/user_update_form">ユーザ情報を更新する</Link></div>
					<div id="form">
						<form id="fetch-form">
							<textarea name="text" id="" cols="50" rows="5" required />
							<input type="hidden" name="csrf_token" value={data.csrf_token} />
							<input type="button" value="投稿" onClick={handleClick} />
						</form>
					</div>
					<div id="posts">
						<table>
							<tr>
								<th>投稿ID</th>
								<th>投稿者</th>
								<th>投稿内容</th>
							</tr>
							{data.posts.map((post) => {
								return <tr>
									<td>{post.post_id}</td>
									<td><Link to={`/user_page?user_id=${post.user_id}`}>{post.name}</Link></td>
									<td>{post.post}</td>
								</tr>
							})}
						</table>
					</div>
					<div id="pagination">
						{data.page_links.map((page_link) => {
							return <Link to={`/?page=${page_link}`}>{page_link}</Link>
						})}
					</div>
					<div id="logout">
						<a href="/logout">ログアウト</a>
					</div>
				</div>
			)}
		</div>
	);
}