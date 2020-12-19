<?php
namespace Http;

/**
 * sessionに関わる関数を扱うクラス
 *
 * @package Http
 */
class Session
{
	/**
	 * session 開始
	 */
	public function start()
	{
		session_start();
	}

	/**
	 * session 終了
	 */
	public function destroy()
	{
		session_destroy();
	}

	/**
	 * @param int $user_id
	 */
	public function setUserId(int $user_id): void
	{
		$_SESSION['user_id'] = $user_id;
	}

	/**
	 * @return int
	 */
	public function getUserId(): int
	{
		return $_SESSION['user_id'];
	}
}