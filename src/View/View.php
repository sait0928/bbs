<?php
namespace View;

/**
 * Viewに関するクラス
 *
 * @package View
 */
class View
{
	/**
	 * 必要な値を受け取って
	 * template を include する
	 *
	 * @param string $path
	 * @param array $params
	 */
	public function render(string $path, array $params = [])
	{
		extract($params);
		include TEMPLATE_DIR . $path;
	}
}