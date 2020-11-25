<?php
namespace View;

class View
{
	public function render(string $path, array $params = [])
	{
		extract($params);
		include TEMPLATE_DIR . $path;
	}
}