<?php
namespace Model\User;

/**
 * ログイン認証に使用する
 * セッション変数を操作するモデル
 *
 * @package Model\User
 */
class AuthStorage
{
	/**
	 * セッション変数を set
	 *
	 * @param User $user
	 */
	public function setStorage(User $user): void
	{
		$_SESSION['user_id'] = $user->getUserId();
	}

	/**
	 * セッション変数を破棄する
	 */
	public function clearStorage(): void
	{
		$_SESSION = array();
		session_destroy();
	}
}