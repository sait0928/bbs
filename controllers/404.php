<?php

function notFoundAction(): void
{
	session_start();

	echo 'ページが見つかりません';
}
