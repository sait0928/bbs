import { Link } from "react-router-dom";
import * as React from "react";
import { useState } from "react";
import { useFetch } from "./hooks";
import { submitFormAsync } from "./submit_form_async";
import { Posts } from "./posts";

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
						<form id="fetch-insert-form">
							<textarea name="text" id="" cols={50} rows={5} required />
							<input type="hidden" name="csrf_token" value={data.csrf_token} />
							<input type="button" value="投稿" onClick={(e) => submitFormAsync(e, version, setVersion, "/insert")} />
						</form>
					</div>
					<div id="posts">
						<Posts data={data} version={version} setVersion={setVersion} />
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