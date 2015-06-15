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

use Maslosoft\Cache\Interfaces\CacheAdapterInterface;

/**
 * Apc cache adapter
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Apc implements CacheAdapterInterface
{

	public function get($key)
	{
		return apc_fetch($key);
	}

	public function has($key)
	{
		return apc_exists($key);
	}

	public function isAvailable()
	{
		return extension_loaded('apc') && ini_get('apc.enabled') == 1;
	}

	public function set($key, $data, $timeout = null)
	{
		return apc_store($key, $data, $timeout);
	}

	public function clear()
	{
		return apc_clear_cache();
	}

	public function remove($key)
	{
		return apc_delete($key);
	}

}
