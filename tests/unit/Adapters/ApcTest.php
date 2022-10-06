<?php

namespace Adapters;

use Codeception\Test\Unit;
use Maslosoft\Cache\Adapters\Apc;
use Maslosoft\CacheTest\Testers\ICacheTester;
use UnitTester;
use function codecept_debug;
use function extension_loaded;
use function ini_get;
use function json_encode;

class ApcTest extends Unit
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
	public function testApcAdapter(): void
	{
		codecept_debug("Extension loaded: " . json_encode(extension_loaded('apcu')));
		$cache = new Apc;

		$enabledOnCli = (bool)ini_get('apc.enable_cli');
		codecept_debug("Enabled on CLI: " . json_encode($enabledOnCli));

		if(!$enabledOnCli)
		{
			$this->markTestSkipped("APC or APCu is not available on CLI mode, check PHP `apc.enable_cli` value");
		}

		if(!$cache->isAvailable())
		{
			$this->markTestSkipped("APC or APCu is not available");
		}

		$this->checkInterface($cache);
	}

}
