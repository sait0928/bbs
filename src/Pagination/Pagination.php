<?php
namespace Pagination;

/**
 * ペジネーションに関するクラス
 *
 * @package Pagination
 */
class Pagination
{
	public const DISPLAY_POSTS = 3;

	/**
	 * 総記事数を元に必要なページ数を計算
	 *
	 * @param int $total_posts
	 * @return int
	 */
	public function countPages(int $total_posts): int
	{
		return ceil($total_posts / self::DISPLAY_POSTS);
	}
}
