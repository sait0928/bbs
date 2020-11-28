<?php
namespace Controller;

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
		session_start();

		echo 'ページが見つかりません';
	}
}
