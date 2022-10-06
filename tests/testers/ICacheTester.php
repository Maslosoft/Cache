<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\CacheTest\Testers;

use Maslosoft\Cache\Interfaces\CacheInterface;

/**
 * ICacheTester
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
trait ICacheTester
{

	public function checkInterface(CacheInterface $cache): void
	{
		$this->runTests($cache);
	}

	public function runTests(CacheInterface $cache): void
	{
		$cache->clear();
		$value = 'Some Value';

		$key = 1;

		$this->assertFalse($cache->has($key), 'Cache does not `has` the key');

		if (!$cache->has($key))
		{
			$cache->set($key, $value);
		}

		$this->assertTrue($cache->has($key), 'Cache `has` the key just stored');
		$this->assertSame($value, $cache->get($key), 'Stored value is same as original');


		$cache->set($key, $value);
		$this->assertTrue($cache->has($key));
		$cache->clear();
		$this->assertFalse($cache->has($key));

		$cache->set($key, $value);
		$this->assertTrue($cache->has($key));
		$cache->remove($key);
		$this->assertFalse($cache->has($key));
	}

}
