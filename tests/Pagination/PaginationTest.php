<?php
namespace Pagination;

use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
	public function testCountPages()
	{
		$pagination = new Pagination();

		$this->assertSame(0, $pagination->countPages(0));
		$this->assertSame(1, $pagination->countPages(1));
		$this->assertSame(1, $pagination->countPages(2));
		$this->assertSame(1, $pagination->countPages(3));
		$this->assertSame(2, $pagination->countPages(4));
		$this->assertSame(2, $pagination->countPages(6));
		$this->assertSame(3, $pagination->countPages(7));
	}
}
