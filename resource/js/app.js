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
					<Route exact path="/" component={Home} />
					<Route exact path="/login_form" component={LoginForm} />
					<Route exact path="/register_form" component={RegisterForm} />
					<Route exact path="/user_page" component={UserPage} />
					<Route exact path="/user_update_form" component={UserUpdateForm} />
				</Switch>
			</div>
		</Router>
	);
}