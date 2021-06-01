import { Link } from "react-router-dom";
import * as React from "react";
import { useFetch } from "./hooks";
import { useState } from "react";
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
						<Posts data={data} version={version} setVersion={setVersion} />
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