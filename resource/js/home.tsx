import { Link } from "react-router-dom";
import * as React from "react";
import { useState } from "react";
import { useFetch } from "./hooks";
import { submitFormAsync } from "./submit_form_async";
import { Posts } from "./posts";
import Button from '@material-ui/core/Button';
import Pagination from '@material-ui/lab/Pagination';
import { useHistory } from 'react-router-dom';
import TextField from '@material-ui/core/TextField';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import Container from '@material-ui/core/Container';
import CssBaseline from '@material-ui/core/CssBaseline';
import Menu from '@material-ui/core/Menu';
import MenuItem from '@material-ui/core/MenuItem';

const useStyles = makeStyles((theme) => ({
	paper: {
		marginTop: theme.spacing(8),
		display: 'flex',
		flexDirection: 'column',
		alignItems: 'center',
		width: 500,
	},
	form: {
		width: 500,
		marginTop: theme.spacing(1),
	},
	textarea: {
		width: 500,
	},
	submit: {
		width: 500,
		margin: theme.spacing(3, 0, 2),
	},
}));

type PostData = {
	post_id: number;
	user_id: number;
	name: string;
	post: string;
}

type PageData = {
	name: string;
	csrf_token: string;
	posts: PostData[];
	current_page: number;
	total_pages: number;
}

export const Home = () => {
	const [anchorEl, setAnchorEl] = React.useState(null);
	const handleClick = (event) => {
		setAnchorEl(event.currentTarget);
	};
	const handleClose = () => {
		setAnchorEl(null);
	};
	const classes = useStyles();
	const history = useHistory();
	const handleLink = path => history.push(path);
	const [version, setVersion] = useState(0);
	const queryString = require('query-string');
	const parsed = queryString.parse(location.search);
	const page = parsed.page || 1;
	const [data, loading] = useFetch("/api/home?page=" + page, version) as [PageData, boolean];
	return (
		<Container component="main" maxWidth="xs">
			<CssBaseline />
			<div className={classes.paper}>
				<Typography component="h1" variant="h5">
					掲示板
				</Typography>
				{loading ? (
					"Loading..."
				) : (
					<div>
						<Button aria-controls="simple-menu" aria-haspopup="true" onClick={handleClick}>
							▼{data.name}さん
						</Button>
						<Menu
							id="simple-menu"
							anchorEl={anchorEl}
							keepMounted
							open={Boolean(anchorEl)}
							onClose={handleClose}
						>
							<MenuItem onClick={handleClose}><Link to="/user_update_form">ユーザ情報編集</Link></MenuItem>
							<MenuItem onClick={handleClose}><a href="/logout">ログアウト</a></MenuItem>
						</Menu>
						<div id="form">
							<form id="fetch-insert-form" className={classes.form}>
								<TextField
									className={classes.textarea}
									id="text"
									name="text"
									label="投稿内容"
									multiline
									required
									rows={4}
									variant="outlined"
								/>
								<input type="hidden" name="csrf_token" value={data.csrf_token} />
								<br />
								<Button
									className={classes.submit}
									variant="contained"
									color="primary"
									onClick={(e) => submitFormAsync(e, version, setVersion, "/insert")}
								>
									投稿
								</Button>
							</form>
						</div>
						<div id="posts">
							<Posts data={data} version={version} setVersion={setVersion} />
						</div>
						<div id="pagination">
							<Pagination
								count={data.total_pages}
								defaultPage={data.current_page}
								onChange={(e, page) => handleLink(`/?page=${page}`)}
							/>
						</div>
					</div>
				)}
			</div>
		</Container>
	);
}