import { Link } from "react-router-dom";
import * as React from "react";
import { useFetch } from "./hooks";
import { useState } from "react";

async function handleClick(e, version, setVersion) {
	const form = document.getElementById("fetch-form");
	if (!(form instanceof HTMLFormElement)) {
		throw new Error('Cannot find the form element');
	}
	var formData = new FormData(form);
	await fetch("/delete", {
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
	session_user_id: number;
	get_user_id: number;
}

export const UserPage = () => {
	const [version, setVersion] = useState(0);
	const queryString = require('query-string');
	const parsed = queryString.parse(location.search);
	const page = parsed.page || 1;
	const user_id = parsed.user_id;
	const [data, loading] = useFetch("/api/user_page?user_id=" + user_id + "&page=" + page, version) as [PageData, boolean];
	return (
		<div>
			<h1>掲示板</h1>
			{loading ? (
				"Loading..."
			) : (
				<div>
					<p>{data.name}さんの投稿一覧</p>
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
							{data.posts.map((post) => {
								return <tr>
									<td>{post.post_id}</td>
									<td>{post.name}</td>
									<td>{post.post}</td>
									{post.user_id === data.session_user_id &&
										<td>
											<form id="fetch-form">
												<input type="hidden" name="id" value={post.post_id} />
												<input type="hidden" name="csrf_token" value={data.csrf_token} />
												<input type="button" value="削除" onClick={(e) => handleClick(e, version, setVersion)} />
											</form>
										</td>
									}
								</tr>
							})}
						</table>
					</div>
					<div id="pagination">
						{data.page_links.map((page_link) => {
							return <Link to={`/user_page?user_id=${data.get_user_id}&page=${page_link}`}>{page_link}</Link>
						})}
					</div>
				</div>
			)}
		</div>
	);
}