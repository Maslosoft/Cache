<?php

namespace Cache;

use Codeception\Test\Unit;
use Maslosoft\Cache\Cache;
use Maslosoft\CacheTest\Testers\ICacheTester;
use ReflectionMethod;
use UnitTester;
use function codecept_debug;
use function get_class;

class AutomaticTest extends Unit
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
		(new Cache())->clear();
	}

	// tests
	public function testIfWillWorkWithoutAnySetup(): void
	{
		$cache = new Cache();

		$method = new ReflectionMethod($cache, 'getAdapter');
		$adapter = $method->invoke($cache);

		codecept_debug("Used adapter: " . get_class($adapter));

		$cache->init();

		$this->checkInterface($cache);
	}

}
