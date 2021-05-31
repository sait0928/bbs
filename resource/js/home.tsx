import { Link } from "react-router-dom";
import * as React from "react";
import { useState } from "react";
import { useFetch } from "./hooks";

async function handleClick(e, version, setVersion) {
	const form = document.getElementById("fetch-form");
	if (!(form instanceof HTMLFormElement)) {
		throw new Error('Cannot find the form element');
	}
	var formData = new FormData(form);
	await fetch("/insert", {
		method: "POST",
		body: formData
	});
	form.reset();
	setVersion(version + 1);
}

type PostData = {
	post_id: number;
	user_id: number;
	name: string;
	post: string;
}

type PageData = {
	name: string;
	csrf_token: string;
	posts: PostData[];
	page_links: string[];
}

export const Home = () => {
	const [version, setVersion] = useState(0);
	const queryString = require('query-string');
	const parsed = queryString.parse(location.search);
	const page = parsed.page || 1;
	const [data, loading] = useFetch("/api/home?page=" + page, version) as [PageData, boolean];
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
							<textarea name="text" id="" cols={50} rows={5} required />
							<input type="hidden" name="csrf_token" value={data.csrf_token} />
							<input type="button" value="投稿" onClick={(e) => handleClick(e, version, setVersion)} />
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