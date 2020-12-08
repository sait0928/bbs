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
	public function __construct()
	{
	}

	public static function createDefault()
	{
		return new self();
	}
	/**
	 * ページが無いことを通知
	 */
	public function notFoundAction(): void
	{
		echo 'ページが見つかりません';
	}
}
