import {Link} from "react-router-dom";
import React from "react";

export const UserPage = () => {
	const params = JSON.parse(app.dataset.params);
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