<?php

namespace Adapters;

use Codeception\Test\Unit;
use Maslosoft\Cache\Adapters\Redis;
use Maslosoft\CacheTest\Testers\ICacheTester;
use UnitTester;

class RedisTest extends Unit
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
	public function testRedisAdapter(): void
	{
		$this->markTestSkipped("Redis not implemented");
		return;
		$cache = new Redis;
		$this->checkInterface($cache);
	}

}
