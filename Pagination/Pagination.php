<?php
namespace Pagination;

class Pagination
{
	public function countPages(int $total_posts): int
	{
		return ceil($total_posts / 3);
	}
}
