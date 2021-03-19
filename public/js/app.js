import React from "react";

import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";

export default function Default() {
	return React.createElement(
		Router,
		null,
		React.createElement(
			"div",
			null,
			React.createElement(
				Switch,
				null,
				React.createElement(
					Route,
					{ exact: true, path: "/" },
					React.createElement(Home, null)
				),
				React.createElement(
					Route,
					{ exact: true, path: "/login_form" },
					React.createElement(LoginForm, null)
				),
				React.createElement(
					Route,
					{ exact: true, path: "/register_form" },
					React.createElement(RegisterForm, null)
				),
				React.createElement(
					Route,
					{ exact: true, path: "/user_page" },
					React.createElement(UserPage, null)
				),
				React.createElement(
					Route,
					{ exact: true, path: "/user_update_form" },
					React.createElement(UserUpdateForm, null)
				)
			)
		)
	);
}

function Home() {
	return React.createElement(
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
			{ id: "user-update" },
			React.createElement(
				Link,
				{ to: "/user_update_form" },
				"\u30E6\u30FC\u30B6\u60C5\u5831\u3092\u66F4\u65B0\u3059\u308B"
			)
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
								Link,
								{ to: "/user_page?user_id=" + post.user_id },
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
					Link,
					{ to: "/?page=" + page_link },
					page_link
				);
			})
		),
		React.createElement(
			"div",
			{ id: "logout" },
			React.createElement(
				Link,
				{ to: "/logout" },
				"\u30ED\u30B0\u30A2\u30A6\u30C8"
			)
		)
	);
}

function LoginForm() {
	return React.createElement(
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
			Link,
			{ to: "/register_form" },
			"\u65B0\u898F\u767B\u9332\u306F\u30B3\u30C1\u30E9"
		)
	);
}

function RegisterForm() {
	return React.createElement(
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
				React.createElement("input", { type: "hidden", name: "csrf_token", value: params.csrf_token }),
				React.createElement("input", { type: "submit", value: "\u65B0\u898F\u767B\u9332" })
			)
		),
		React.createElement(
			Link,
			{ to: "/login_form" },
			"\u30ED\u30B0\u30A4\u30F3\u306F\u30B3\u30C1\u30E9"
		)
	);
}

function UserPage() {
	return React.createElement(
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
				Link,
				{ to: "/" },
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
					Link,
					{ to: "/user_page?user_id=" + params.get_user_id + "&page=" + page_link },
					page_link
				);
			})
		)
	);
}

function UserUpdateForm() {
	return React.createElement(
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
				"\u30E6\u30FC\u30B6\u540D\u3092\u5909\u66F4:",
				React.createElement("input", { type: "text", name: "name", id: "name" }),
				React.createElement("br", null),
				"\u30E1\u30FC\u30EB\u30A2\u30C9\u30EC\u30B9\u3092\u5909\u66F4:",
				React.createElement("input", { type: "email", name: "email", id: "email" }),
				React.createElement("br", null),
				"\u30D1\u30B9\u30EF\u30FC\u30C9\u3092\u5909\u66F4:",
				React.createElement("input", { type: "password", name: "pass", id: "pass" }),
				React.createElement("br", null),
				"\u5909\u66F4\u5F8C\u30D1\u30B9\u30EF\u30FC\u30C9\u518D\u5165\u529B:",
				React.createElement("input", { type: "password", name: "again", id: "again" }),
				React.createElement("br", null),
				React.createElement("input", { type: "hidden", name: "csrf_token", value: params.csrf_token }),
				React.createElement("input", { type: "submit", value: "\u66F4\u65B0" })
			)
		),
		React.createElement(
			Link,
			{ to: "/" },
			"\u2190\u623B\u308B"
		)
	);
}