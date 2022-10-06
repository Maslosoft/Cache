<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cache;

use Codeception\Test\Unit;
use Maslosoft\Cache\Cache;

/**
 * NamespacedTest
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class NamespacedTest extends Unit
{

	public function testIfAllowSameKeyForDifferentNamespace(): void
	{
		$cache1 = new Cache();
		$cache1->keyspace = 'one';

		$cache2 = new Cache();
		$cache2->keyspace = 'two';

		$cache1->set(1, 'one');
		$cache2->set(1, 'two');

		$val1 = $cache1->get(1);
		$val2 = $cache2->get(1);

		$this->assertSame('one', $val1);
		$this->assertSame('two', $val2);
	}

}
