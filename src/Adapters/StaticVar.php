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
 * Static
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class StaticVar implements ICacheAdapter
{

	private static $_values = [];
	private static $_ttls = [];

	public function get($key)
	{
		if ($this->has($key))
		{
			return self::$_values[$key];
		}
		return null;
	}

	public function has($key)
	{
		if(!array_key_exists($key, self::$_ttls))
		{
			return false;
		}
		$ttl = self::$_ttls[$key];
		if(0 === $ttl)
		{
			return true;
		}
		return $ttl >= time();
	}

	public function isAvailable()
	{
		return true;
	}

	public function set($key, $data, $timeout = null)
	{
		self::$_values[$key] = $data;
		if ($timeout)
		{
			$ttl = time() + $timeout;
		}
		else
		{
			$ttl = 0;
		}
		self::$_ttls[$key] = $ttl;
	}

	public function clear()
	{
		self::$_values = [];
		self::$_ttls = [];
	}

	public function remove($key)
	{
		unset(self::$_values[$key]);
		unset(self::$_ttls[$key]);
	}

}
