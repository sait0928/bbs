<?php
namespace Model\User;

use Http\Session;

/**
 * ログイン認証に使用する
 * セッション変数を操作するモデル
 *
 * @package Model\User
 */
class AuthStorage
{
	private Session $session;

	public function __construct(
		Session $session
	) {
		$this->session = $session;
	}

	/**
	 * セッション変数を set
	 *
	 * @param User $user
	 */
	public function setStorage(User $user): void
	{
		$this->session->setUserId($user->getUserId());
	}

	/**
	 * セッション変数を破棄する
	 */
	public function clearStorage(): void
	{
		$_SESSION = array();
		$this->session->destroy();
	}
}