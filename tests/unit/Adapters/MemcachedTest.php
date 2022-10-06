<?php

namespace Adapters;

use Codeception\Test\Unit;
use Maslosoft\Cache\Adapters\Memcached;
use Maslosoft\CacheTest\Testers\ICacheTester;
use UnitTester;

class MemcachedTest extends Unit
{

	use ICacheTester;

	/**
	 * @var UnitTester
	 */
	protected $tester;

	protected function _before()
	{
		
	}

	protected function _after()
	{
		
	}

	// tests
	public function testMemcachedAdapter(): void
	{
		$cache = new Memcached;

		if(!$cache->isAvailable())
		{
			$this->markTestSkipped("Memcached is not available");
		}

		$this->checkInterface($cache);
	}

}
