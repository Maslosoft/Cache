<?php

namespace Adapters;

use Codeception\Test\Unit;
use Maslosoft\Cache\Adapters\StaticVar;
use Maslosoft\CacheTest\Testers\ICacheTester;
use UnitTester;

class StaticVarTest extends Unit
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
	public function testStaticVarAdapter(): void
	{
		$cache = new StaticVar;
		$this->checkInterface($cache);
	}

}
