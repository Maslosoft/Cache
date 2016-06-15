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
 * Apc and Apcu cache adapter
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Apc implements CacheAdapterInterface
{

	private $apcu = false;

	public function __construct()
	{
		$this->apcu = extension_loaded('apcu');
	}

	public function get($key)
	{
		if ($this->apcu)
		{
			return apcu_fetch((string) $key);
		}
		return apc_fetch((string) $key);
	}

	public function has($key)
	{
		if ($this->apcu)
		{
			return apcu_exists((string) $key);
		}
		return apc_exists((string) $key);
	}

	public function isAvailable()
	{
		return (extension_loaded('apc') || extension_loaded('apcu')) && ini_get('apc.enabled') == 1;
	}

	public function set($key, $data, $timeout = null)
	{
		if ($this->apcu)
		{
			return apcu_store((string) $key, $data, $timeout);
		}
		return apc_store((string) $key, $data, $timeout);
	}

	public function clear()
	{
		if ($this->apcu)
		{
			return apcu_clear_cache();
		}
		return apc_clear_cache();
	}

	public function remove($key)
	{
		if ($this->apcu)
		{
			return apcu_delete((string) $key);
		}
		return apc_delete((string) $key);
	}

}
