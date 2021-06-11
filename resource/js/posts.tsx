import { Link } from "react-router-dom";
import * as React from "react";
import { submitFormAsync } from "./submit_form_async";
import Button from "@material-ui/core/Button";

export const Posts = (props) => {
    return (
        <div>
            <table>
                <tr>
                    <th>投稿ID</th>
                    <th>投稿者</th>
                    <th>投稿内容</th>
                </tr>
                {props.data.posts.map((post) => {
                    return <tr>
                        <td>{post.post_id}</td>
                        <td><Link to={`/user_page?user_id=${post.user_id}`}>{post.name}</Link></td>
                        <td>{post.post}</td>
                        {post.user_id === props.data.session_user_id &&
                            <td>
                                <form id="fetch-delete-form">
                                    <input type="hidden" name="id" value={post.post_id} />
                                    <input type="hidden" name="csrf_token" value={props.data.csrf_token} />
                                    <Button variant="contained" color="primary" onClick={(e) => submitFormAsync(e, props.version, props.setVersion, "/delete")}>
                                        削除
                                    </Button>
                                </form>
                            </td>
                        }
                    </tr>
                })}
            </table>
        </div>
    );
}