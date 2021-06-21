import { Link } from "react-router-dom";
import * as React from "react";
import { submitFormAsync } from "./submit_form_async";
import Button from "@material-ui/core/Button";
import { makeStyles } from '@material-ui/core/styles';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';

const useStyles = makeStyles({
    table_name: {
        width: 100,
    },
    table_text: {
        width: 300,
    },
    table_delete: {
        width: 100,
    },
});

export const Posts = (props) => {
    const classes = useStyles();
    return (
        <TableContainer component={Paper}>
            <Table size="small" aria-label="simple table">
                <TableHead>
                    <TableRow>
                        <TableCell className={classes.table_name}>投稿者</TableCell>
                        <TableCell className={classes.table_text}>投稿内容</TableCell>
                        <TableCell className={classes.table_delete}>投稿削除</TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {props.data.posts.map((post) => (
                        <TableRow key={post.post_id}>
                            <TableCell>
                                <Link to={`/user_page?user_id=${post.user_id}`}>{post.name}</Link>
                            </TableCell>
                            <TableCell>{post.post}</TableCell>
                            {post.user_id === props.data.session_user_id &&
                            <TableCell>
                                <form id="fetch-delete-form">
                                    <input type="hidden" name="id" value={post.post_id} />
                                    <input type="hidden" name="csrf_token" value={props.data.csrf_token} />
                                    <Button variant="contained" color="primary" onClick={(e) => submitFormAsync(e, props.version, props.setVersion, "/delete")}>
                                        削除
                                    </Button>
                                </form>
                            </TableCell>
                            }
                        </TableRow>
                    ))}
                </TableBody>
            </Table>
        </TableContainer>
    );
}