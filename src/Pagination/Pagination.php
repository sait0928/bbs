<?php
namespace Pagination;

/**
 * ペジネーションに関するクラス
 *
 * @package Pagination
 */
class Pagination
{
	private const DISPLAY_POSTS = 3;
	private const PAGE_LINKS_MAX = 5;

	/**
	 * 総記事数を元に必要なページ数を計算
	 *
	 * @param int $total_posts
	 * @return int
	 */
	public function countPages(int $total_posts): int
	{
		if($total_posts === 0) {
			return 1;
		}

		$result =  ceil($total_posts / self::DISPLAY_POSTS);
		return (int)$result;
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
		$page_links = [];
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

	/**
	 * @return int
	 */
	public function getDisplayPosts(): int
	{
		return self::DISPLAY_POSTS;
	}
}
