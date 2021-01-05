const root = document.getElementById('root');
const params = JSON.parse(root.dataset.params);

ReactDOM.render(
	<div>
		<h1>掲示板</h1>
		<p>ようこそ{params.name}さん！</p>
		<div id="form">
			<form action="/insert" method="POST">
				<textarea name="text" id="" cols="50" rows="5" required />
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
						<td><a href={`/user_page?user_id=${post.user_id}`}>{post.name}</a></td>
						<td>{post.post}</td>
					</tr>
				})}
			</table>
		</div>
		<div id="pagination">
			{params.page_links.map((page_link) => {
				return <a href={`/?page=${page_link}`}>{page_link}</a>
			})}
		</div>
		<div id="logout">
			<a href="/logout">ログアウト</a>
		</div>
	</div>,
	root
);