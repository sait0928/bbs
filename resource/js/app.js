import React from "react";
import {
	BrowserRouter as Router,
	Switch,
	Route,
} from "react-router-dom";

import {Home} from "./home";
import {LoginForm} from "./login_form";
import {RegisterForm} from "./register_form";
import {UserPage} from "./user_page";
import {UserUpdateForm} from "./user_update_form";

export const App = () => {
	return (
		<Router>
			<div>
				<Switch>
					<Route exact path="/">
						<Home />
					</Route>
					<Route exact path="/login_form">
						<LoginForm />
					</Route>
					<Route exact path="/register_form">
						<RegisterForm />
					</Route>
					<Route exact path="/user_page">
						<UserPage />
					</Route>
					<Route exact path="/user_update_form">
						<UserUpdateForm />
					</Route>
				</Switch>
			</div>
		</Router>
	);
}