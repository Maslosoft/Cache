<?php

/**
 * This software package is licensed under New BSD license.
 *
 * @package maslosoft/cache
 * @licence New BSD
 *
 * @copyright Copyright (c) Peter Maselkowski <pmaselkowski@gmail.com>
 *
 */

namespace Maslosoft\Cache\Adapters;

use Maslosoft\Cache\Interfaces\ICacheAdapter;

/**
 * Cascade
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Cascade implements ICacheAdapter
{

	public $adapters = [
		Apc::class => true,
		StaticVar::class => true,
	];

	public function get($key)
	{
		
	}

	public function has($key)
	{

	}

	public function isAvailable()
	{
		
	}

	public function set($key, $data, $timeout = null)
	{

	}

	public function clear()
	{

	}

	public function remove($key)
	{

	}

}
