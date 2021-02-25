<?php
namespace Pagination;

use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
	public function testCountPages()
	{
		$pagination = new Pagination();

		$this->assertSame(1, $pagination->countPages(0));
		$this->assertSame(1, $pagination->countPages(1));
		$this->assertSame(1, $pagination->countPages(2));
		$this->assertSame(1, $pagination->countPages(3));
		$this->assertSame(2, $pagination->countPages(4));
		$this->assertSame(2, $pagination->countPages(6));
		$this->assertSame(3, $pagination->countPages(7));
	}

	public function testCreatePageLinksArray()
	{
		$pagination = new Pagination();

		$this->assertSame([1, 2, 3], $pagination->createPageLinksArray(1, 3));
		$this->assertSame([1, 2, 3, 4, 5], $pagination->createPageLinksArray(2, 10));
		$this->assertSame([3, 4, 5, 6, 7], $pagination->createPageLinksArray(5, 10));
		$this->assertSame([6, 7, 8, 9, 10], $pagination->createPageLinksArray(9, 10));
	}
}
