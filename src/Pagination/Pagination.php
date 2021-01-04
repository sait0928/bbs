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
	public const PAGE_LINKS_MAX = 5;

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

	/**
	 * 現在のページ番号を元に生成するページリンクの番号を決定する
	 *
	 * @param int $current_page
	 * @param int $total_pages
	 * @return array
	 */
	public function createPageLinksArray(int $current_page, int $total_pages): array
	{
		if($total_pages < self::PAGE_LINKS_MAX) {
			for($i = 1; $i <= $total_pages; $i++) {
				$page_links[] = $i;
			}
			return $page_links;
		}
		switch($current_page) {
			case 1:
			case 2:
				return [1, 2, 3, 4, 5];
				break;
			case $total_pages - 1:
			case $total_pages:
				return [$total_pages - 4, $total_pages - 3, $total_pages - 2, $total_pages - 1, $total_pages];
				break;
			default:
				return [$current_page - 2, $current_page - 1, $current_page, $current_page + 1, $current_page + 2];
		}
	}
}
