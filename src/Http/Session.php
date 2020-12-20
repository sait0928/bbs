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
	 * @param string $key
	 * @param int $user_id
	 */
	public function set(string $key, int $user_id): void
	{
		$_SESSION[$key] = $user_id;
	}

	/**
	 * @param string $key
	 * @return int
	 */
	public function get(string $key): int
	{
		return $_SESSION[$key];
	}

	/**
	 * session 変数の初期化
	 */
	public function unset(): void
	{
		$_SESSION = array();
	}
}