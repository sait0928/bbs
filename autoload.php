<?php

class Autoloader
{
	public static function load(string $class_name) {
		$file_path = SOURCE_DIR . '/' . str_replace('\\', '/', $class_name) . '.php';
		include_once($file_path);
	}
}
