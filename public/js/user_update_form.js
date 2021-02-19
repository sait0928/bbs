var root = document.getElementById('root');
var params = JSON.parse(root.dataset.params);

ReactDOM.render(React.createElement(
	"div",
	null,
	React.createElement(
		"h1",
		null,
		"\u30E6\u30FC\u30B6\u60C5\u5831\u66F4\u65B0"
	),
	React.createElement(
		"div",
		{ id: "user-update-form" },
		React.createElement(
			"form",
			{ action: "/user_update", method: "POST" },
			React.createElement(
				"p",
				null,
				"\u5909\u66F4\u3057\u305F\u3044\u9805\u76EE\u306E\u307F\u5165\u529B\u3057\u3066\u304F\u3060\u3055\u3044"
			),
			React.createElement(
				"label",
				{ htmlFor: "email" },
				"\u30E6\u30FC\u30B6\u540D\u3092\u5909\u66F4:",
				React.createElement("input", { type: "text", name: "name", id: "name" })
			),
			React.createElement("br", null),
			React.createElement(
				"label",
				{ htmlFor: "pass" },
				"\u30E1\u30FC\u30EB\u30A2\u30C9\u30EC\u30B9\u3092\u5909\u66F4:",
				React.createElement("input", { type: "email", name: "email", id: "email" })
			),
			React.createElement("br", null),
			React.createElement(
				"label",
				{ htmlFor: "pass" },
				"\u30D1\u30B9\u30EF\u30FC\u30C9\u3092\u5909\u66F4:",
				React.createElement("input", { type: "password", name: "new_pass", id: "new_pass" })
			),
			React.createElement("br", null),
			React.createElement(
				"label",
				{ htmlFor: "pass" },
				"\u5909\u66F4\u5F8C\u30D1\u30B9\u30EF\u30FC\u30C9\u518D\u5165\u529B:",
				React.createElement("input", { type: "password", name: "again", id: "again" })
			),
			React.createElement("br", null),
			React.createElement("input", { type: "hidden", name: "csrf_token", value: params.csrf_token }),
			React.createElement("input", { type: "submit", value: "\u66F4\u65B0" })
		)
	),
	React.createElement(
		"a",
		{ href: "/" },
		"\u2190\u623B\u308B"
	)
), root);