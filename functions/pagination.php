<?php

/**
 * ページ総数のカウント
 *
 * @param int $total_posts
 * @return int
 */
function countPages(int $total_posts): int
{
	return ceil($total_posts / 3);
}
