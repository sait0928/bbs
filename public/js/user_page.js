var root = document.getElementById('root');
var params = JSON.parse(root.dataset.params);

ReactDOM.render(React.createElement(
	"div",
	null,
	React.createElement(
		"h1",
		null,
		"\u63B2\u793A\u677F"
	),
	React.createElement(
		"p",
		null,
		params.name,
		"\u3055\u3093\u306E\u6295\u7A3F\u4E00\u89A7"
	),
	React.createElement(
		"div",
		{ id: "return" },
		React.createElement(
			"a",
			{ href: "/" },
			"\u2190\u623B\u308B"
		)
	),
	React.createElement(
		"div",
		{ id: "posts" },
		React.createElement(
			"table",
			null,
			React.createElement(
				"tr",
				null,
				React.createElement(
					"th",
					null,
					"\u6295\u7A3FID"
				),
				React.createElement(
					"th",
					null,
					"\u6295\u7A3F\u8005"
				),
				React.createElement(
					"th",
					null,
					"\u6295\u7A3F\u5185\u5BB9"
				)
			),
			params.posts.map(function (post) {
				return React.createElement(
					"tr",
					null,
					React.createElement(
						"td",
						null,
						post.post_id
					),
					React.createElement(
						"td",
						null,
						post.name
					),
					React.createElement(
						"td",
						null,
						post.post
					),
					post.user_id === params.session_user_id && React.createElement(
						"td",
						null,
						React.createElement(
							"form",
							{ action: "/delete", method: "POST" },
							React.createElement("input", { type: "hidden", name: "id", value: post.post_id }),
							React.createElement("input", { type: "hidden", name: "csrf_token", value: params.csrf_token }),
							React.createElement("input", { type: "submit", value: "\u524A\u9664" })
						)
					)
				);
			})
		)
	),
	React.createElement(
		"div",
		{ id: "pagination" },
		params.page_links.map(function (page_link) {
			return React.createElement(
				"a",
				{ href: "/user_page?user_id=" + params.get_user_id + "&page=" + page_link },
				page_link
			);
		})
	)
), root);