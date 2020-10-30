<?php

/**
 * リダイレクト
 *
 * @param string $url
 */
function redirect(string $url): void
{
	header('Location: '.$url);
	exit;
}
