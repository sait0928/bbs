import { Link } from "react-router-dom";
import * as React from "react";
import { useState } from "react";
import { useFetch } from "./hooks";
import { submitFormAsync } from "./submit_form_async";
import { Posts } from "./posts";
import Button from '@material-ui/core/Button';
import Grid from '@material-ui/core/Grid';

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
		<Grid container alignItems="center" justify="center">
			<Grid item xs={4}>
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
								<Button variant="contained" color="primary" onClick={(e) => submitFormAsync(e, version, setVersion, "/insert")}>
									投稿
								</Button>
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
			</Grid>
		</Grid>
	);
}