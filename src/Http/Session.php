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
	public function start(): void
	{
		session_start();
	}

	/**
	 * session 終了
	 */
	public function destroy(): void
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
	 * @return mixed
	 */
	public function get(string $key)
	{
		return $_SESSION[$key] ?? null;
	}

	/**
	 * session 変数の初期化
	 */
	public function unset(): void
	{
		$_SESSION = array();
	}
}