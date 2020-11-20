<?php
namespace Http;

class Http
{
	public function redirect(string $url): void
	{
		header('Location: '.$url);
		exit;
	}
}
