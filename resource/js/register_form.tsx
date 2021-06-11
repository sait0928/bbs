import {Link} from "react-router-dom";
import * as React from "react";
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TextField from '@material-ui/core/TextField';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import Container from '@material-ui/core/Container';

const useStyles = makeStyles((theme) => ({
	paper: {
		marginTop: theme.spacing(8),
		display: 'flex',
		flexDirection: 'column',
		alignItems: 'center',
	},
	form: {
		width: '100%', // Fix IE 11 issue.
		marginTop: theme.spacing(1),
	},
	submit: {
		margin: theme.spacing(3, 0, 2),
	},
}));

export const RegisterForm = () => {
	const classes = useStyles();
	const app = document.getElementById('app');
	const params = JSON.parse(app.dataset.params);
	return (
		<Container component="main" maxWidth="xs">
			<CssBaseline />
			<div className={classes.paper}>
				<Typography component="h1" variant="h5">
					新規登録
				</Typography>
				<div id="register-form">
					<form className={classes.form} action="/register" method="POST">
						<TextField
							variant="outlined"
							margin="normal"
							required
							fullWidth
							id="name"
							label="Name"
							name="name"
							autoComplete="name"
							autoFocus
						/>
						<TextField
							variant="outlined"
							margin="normal"
							required
							fullWidth
							id="email"
							label="Email Address"
							name="email"
							autoComplete="email"
						/>
						<TextField
							variant="outlined"
							margin="normal"
							required
							fullWidth
							name="pass"
							label="Password"
							type="password"
							id="pass"
							autoComplete="current-password"
						/>
						<TextField
							variant="outlined"
							margin="normal"
							required
							fullWidth
							name="again"
							label="Password Again"
							type="password"
							id="again"
							autoComplete="current-password"
						/>
						<input type="hidden" name="csrf_token" value={params.csrf_token} />
						<Button
							type="submit"
							fullWidth
							variant="contained"
							color="primary"
							className={classes.submit}
						>
							新規登録
						</Button>
					</form>
				</div>
				<Link to="/login_form">ログインはコチラ</Link>
			</div>
		</Container>
	);
}