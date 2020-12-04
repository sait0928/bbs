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
	private Session $session;

	public function __construct(
		Session $session
	) {
		$this->session = $session;
	}

	public static function createDefault()
	{
		return new self(
			new Session()
		);
	}
	/**
	 * ページが無いことを通知
	 */
	public function notFoundAction(): void
	{
		$this->session->start();

		echo 'ページが見つかりません';
	}
}
