<?php
namespace Http;

class Session
{
	public function start()
	{
		session_start();
	}

	public function destroy()
	{
		session_destroy();
	}
}