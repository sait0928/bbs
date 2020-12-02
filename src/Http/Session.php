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
}