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
		$this->session->set('user_id', $user->getUserId());
	}

	/**
	 * セッション変数が入っているか確認
	 *
	 * @return bool
	 */
	public function issetStorage(): bool
	{
		$user_id = $this->session->get('user_id');
		assert(is_int($user_id) or is_null($user_id));
		return isset($user_id);
	}

	/**
	 * セッション変数を破棄する
	 */
	public function clearStorage(): void
	{
		$this->session->unset();
		$this->session->destroy();
	}
}