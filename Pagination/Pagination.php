<?php
namespace Pagination;

class Pagination
{
	function countPages(int $total_posts): int
	{
		return ceil($total_posts / 3);
	}
}