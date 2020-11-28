<?php
namespace Controller;

use Http\Http;
use Model\Post\PostWriter;

/**
 * '/insert' にアクセスされた時に
 * 使用するコントローラー
 *
 * Class InsertController
 * @package Controller
 */
class InsertController
{
	/**
	 * POST通信で送られてきたテキストと
	 * ログインユーザーのIDを
	 * postsに挿入する
	 */
	public function insertAction(): void
	{
		session_start();

		$http = new Http();

		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$http->redirect('/');
		}

		$post_writer = new PostWriter();
		$post_writer->insert($_POST['text'], $_POST['user_id']);

		$http->redirect('/');
	}
}
