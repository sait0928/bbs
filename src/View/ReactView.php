<?php
namespace View;

/**
 * Reactを使う場合に使用するクラス
 *
 * @package View
 */
class ReactView
{
	/**
	 * 必要な値を受け取ってjson化し、
	 * template を include する
	 *
	 * @param string $path
	 * @param array $params
	 */
	public function render(string $path, array $params = [])
	{
		$json_params = \json_encode($params);
		include TEMPLATE_DIR . $path;
	}
}