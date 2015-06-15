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

use Maslosoft\Cache\Interfaces\CacheInterface;
use Maslosoft\Cache\Interfaces\CacheAdapterInterface;
use Maslosoft\Cache\Interfaces\ChildCacheInterface;
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
	 * @return CacheAdapterInterface
	 */
	public static function create($adapters, CacheInterface $parent = null)
	{
		foreach (self::_create($adapters, $parent) as $adapter)
		{
			return $adapter;
		}
	}

	/**
	 * Create all available adapters based on configuration
	 * @param mixed[] $adapters
	 * @return CacheAdapterInterface[] Key is class name
	 */
	public static function createAll($adapters, CacheInterface $parent = null)
	{
		$result = [];
		foreach (self::_create($adapters, $parent) as $adapter)
		{
			$key = get_class($adapter);
			$result[$key] = $adapter;
		}
		return $result;
	}

	private static function _create($adapters, CacheInterface $parent = null)
	{
		foreach ($adapters as $className => $config)
		{
			if (!$config)
			{
				continue;
			}
			$adapter = new $className;
			/* @var $adapter CacheAdapterInterface */
			if ($adapter->isAvailable())
			{
				if (is_array($config))
				{
					(new EmbeDi())->apply($config, $adapter);
				}

				// Parent cache config
				if ($parent && $adapter instanceof ChildCacheInterface)
				{
					$adapter->setParent($parent);
				}
				yield $adapter;
			}
		}
	}

}
