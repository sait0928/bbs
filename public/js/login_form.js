var root = document.getElementById('root');
var params = JSON.parse(root.dataset.params);

ReactDOM.render(React.createElement(
	"div",
	null,
	React.createElement(
		"h1",
		null,
		"\u30ED\u30B0\u30A4\u30F3"
	),
	React.createElement(
		"div",
		{ id: "login-form" },
		React.createElement(
			"form",
			{ action: "/login", method: "POST" },
			React.createElement(
				"label",
				{ htmlFor: "email" },
				"\u30E1\u30FC\u30EB\u30A2\u30C9\u30EC\u30B9:",
				React.createElement("input", { type: "email", name: "email", id: "email", required: true })
			),
			React.createElement("br", null),
			React.createElement(
				"label",
				{ htmlFor: "pass" },
				"\u30D1\u30B9\u30EF\u30FC\u30C9:",
				React.createElement("input", { type: "password", name: "pass", id: "pass", required: true })
			),
			React.createElement("br", null),
			React.createElement("input", { type: "hidden", name: "csrf_token", value: params.csrf_token }),
			React.createElement("input", { type: "submit", value: "\u30ED\u30B0\u30A4\u30F3" })
		)
	),
	React.createElement(
		"a",
		{ href: "/register_form" },
		"\u65B0\u898F\u767B\u9332\u306F\u30B3\u30C1\u30E9"
	)
), document.getElementById('root'));