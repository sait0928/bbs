<?php

class Autoloader
{
	public static function load(string $class_name) {
		$file_path = SOURCE_DIR . '/' . str_replace('\\', '/', $class_name) . '.php';
		if(file_exists($file_path)) {
			include_once($file_path);
		}
	}
}
