ReactDOM.render(React.createElement(
	"div",
	null,
	React.createElement(
		"h1",
		null,
		"\u65B0\u898F\u767B\u9332"
	),
	React.createElement(
		"div",
		{ id: "register-form" },
		React.createElement(
			"form",
			{ action: "/register", method: "POST" },
			React.createElement(
				"label",
				{ htmlFor: "name" },
				"\u540D\u524D:",
				React.createElement("input", { type: "text", name: "name", id: "name", required: true })
			),
			React.createElement("br", null),
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
				"\u30D1\u30B9\u30EF\u30FC\u30C9\u8A2D\u5B9A:",
				React.createElement("input", { type: "password", name: "pass", id: "pass", required: true })
			),
			React.createElement("br", null),
			React.createElement(
				"label",
				{ htmlFor: "again" },
				"\u30D1\u30B9\u30EF\u30FC\u30C9\u518D\u5165\u529B:",
				React.createElement("input", { type: "password", name: "again", id: "again", required: true })
			),
			React.createElement("br", null),
			React.createElement("input", { type: "submit", value: "\u65B0\u898F\u767B\u9332" })
		)
	),
	React.createElement(
		"a",
		{ href: "/login_form" },
		"\u30ED\u30B0\u30A4\u30F3\u306F\u30B3\u30C1\u30E9"
	)
), document.getElementById('root'));