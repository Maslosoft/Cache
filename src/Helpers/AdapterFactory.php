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

namespace Maslosoft\Cache\Helpers;

use Maslosoft\Cache\Interfaces\ICache;
use Maslosoft\Cache\Interfaces\ICacheAdapter;
use Maslosoft\Cache\Interfaces\IChildCache;
use Maslosoft\EmbeDi\EmbeDi;

/**
 * AdapterFactory
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class AdapterFactory
{

	/**
	 * Create first available adapter based on configuration
	 * @param mixed[] $adapters
	 * @return ICacheAdapter
	 */
	public static function create($adapters, ICache $parent = null)
	{
		foreach (self::_create($adapters, $parent) as $adapter)
		{
			return $adapter;
		}
	}

	/**
	 * Create all available adapters based on configuration
	 * @param mixed[] $adapters
	 * @return ICacheAdapter[] Key is class name
	 */
	public static function createAll($adapters, ICache $parent = null)
	{
		$result = [];
		foreach (self::_create($adapters, $parent) as $adapter)
		{
			$key = get_class($adapter);
			$result[$key] = $adapter;
		}
		return $result;
	}

	private static function _create($adapters, ICache $parent = null)
	{
		foreach ($adapters as $className => $config)
		{
			if (!$config)
			{
				continue;
			}
			$adapter = new $className;
			/* @var $adapter ICacheAdapter */
			if ($adapter->isAvailable())
			{
				if (is_array($config))
				{
					(new EmbeDi())->apply($config, $adapter);
				}

				// Parent cache config
				if ($parent && $adapter instanceof IChildCache)
				{
					$adapter->setParent($parent);
				}
				yield $adapter;
			}
		}
	}

}
