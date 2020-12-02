<?php
namespace Controller;

use Http\Session;

/**
 * 存在しないURLにアクセスした時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class NotFoundController
{
	/**
	 * ページが無いことを通知
	 */
	public function notFoundAction(): void
	{
		$session = new Session();
		$session->start();

		echo 'ページが見つかりません';
	}
}
