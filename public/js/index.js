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
		"\u3088\u3046\u3053\u305D",
		params.name,
		"\u3055\u3093\uFF01"
	),
	React.createElement(
		"div",
		{ id: "form" },
		React.createElement(
			"form",
			{ action: "/insert", method: "POST" },
			React.createElement("textarea", { name: "text", id: "", cols: "50", rows: "5", required: true }),
			React.createElement("input", { type: "hidden", name: "csrf_token", value: params.csrf_token }),
			React.createElement("input", { type: "submit", value: "\u6295\u7A3F" })
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
						React.createElement(
							"a",
							{ href: "/user_page?user_id=" + post.user_id },
							post.name
						)
					),
					React.createElement(
						"td",
						null,
						post.post
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
				{ href: "/?page=" + page_link },
				page_link
			);
		})
	),
	React.createElement(
		"div",
		{ id: "logout" },
		React.createElement(
			"a",
			{ href: "/logout" },
			"\u30ED\u30B0\u30A2\u30A6\u30C8"
		)
	)
), root);