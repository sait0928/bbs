<?php
namespace View;

class JsonResponseView
{
	/**
	 * @param array $params
	 */
	public function echoJson(array $params = []): void
	{
		echo \json_encode($params);
	}
}