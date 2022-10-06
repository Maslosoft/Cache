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

namespace Maslosoft\Cache;

use Maslosoft\Cache\Adapters\Apc;
use Maslosoft\Cache\Adapters\Memcached;
use Maslosoft\Cache\Adapters\StaticVar;
use Maslosoft\Cache\Helpers\AdapterFactory;
use Maslosoft\Cache\Interfaces\CacheAdapterInterface;
use Maslosoft\Cache\Interfaces\CacheInterface;
use Maslosoft\EmbeDi\EmbeDi;

/**
 * Cache
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Cache implements CacheInterface
{

	public const Minute = 60;
	public const Hour = 3600;
	public const Day = 86400;
	public const Week = 604800;

	/**
	 * Assumed 30 days
	 */
	public const Month = 18144000;

	/**
	 * Assumed 91 days
	 */
	public const Quarter = 7862400;
	public const Year = 31536000;
	public const DefaultCacheId = 'cache';

	/**
	 * @var string|null
	 */
	private static ?string $version = null;

	/**
	 * Adapters configuration
	 * @var array
	 */
	public array $adapters = [
		Memcached::class => true,
		Apc::class => true,
		StaticVar::class => true,
	];

	/**
	 * Default cache timeout
	 * @var int
	 */
	public int $timeout = 600;

	/**
	 * Namespace for cache keys. This is to allow multi-tenant applications.
	 * @var string
	 */
	public string $keyspace = '';

	/**
	 *
	 * @var CacheAdapterInterface|null
	 */
	private ?CacheAdapterInterface $adapter = null;

	/**
	 *
	 * @var EmbeDi
	 */
	private EmbeDi $di;

	/**
	 * Instances of cache
	 * @var Cache[]
	 */
	private static array $caches = [];

	public function __construct($instanceId = 'cache')
	{
		$this->di = new EmbeDi($instanceId);
		$this->di->configure($this);
	}

	/**
	 * Get flyweight instance of Cache component.
	 * Only one instance will be created for each `$cacheId`.
	 *
	 * @new
	 * @param string $cacheId
	 * @return Cache
	 */
	public static function fly(string $cacheId = self::DefaultCacheId): Cache
	{
		if (empty($cacheId))
		{
			$cacheId = self::DefaultCacheId;
		}
		if (empty(self::$caches[$cacheId]))
		{
			self::$caches[$cacheId] = new static($cacheId);
		}
		return self::$caches[$cacheId];
	}

	public function init(): void
	{
		$this->di->store($this);
	}

	/**
	 * Get cached object.
	 *
	 * Optionally if fail, call callback and store it's return value.
	 * In this case this will also return callback value.
	 *
	 * When using with callback optionally `$timeout` can be specified.
	 *
	 * @param string $key
	 * @param callback $callback
	 * @param int $timeout
	 * @return mixed
	 */
	public function get($key, $callback = null, $timeout = null)
	{
		$data = $this->getAdapter()->get($this->keyspace . $key);
		if (null === $callback)
		{
			return $data;
		}
		if (empty($data))
		{
			$data = call_user_func($callback);
			$this->set($key, $data, $timeout);
		}
		return $data;
	}

	public function has($key)
	{
		return $this->getAdapter()->has($this->keyspace . $key);
	}

	public function set($key, $data, $timeout = null)
	{
		if (null === $timeout)
		{
			$timeout = $this->timeout;
		}
		return $this->getAdapter()->set($this->keyspace . $key, $data, $timeout);
	}

	public function clear()
	{
		return $this->getAdapter()->clear();
	}

	/**
	 * Alias to clear
	 */
	public function flush()
	{
		$this->clear();
	}

	public function remove($key)
	{
		return $this->getAdapter()->remove($this->keyspace . $key);
	}

	/**
	 * Get cache adapter
	 * @return CacheAdapterInterface
	 */
	private function getAdapter(): CacheAdapterInterface
	{
		if (null === $this->adapter)
		{
			$this->adapter = AdapterFactory::create($this->adapters, $this);
		}
		assert($this->adapter !== null);
		return $this->adapter;
	}

	public function getVersion(): string
	{
		if(self::$version === null)
		{
			self::$version = require __DIR__ . '/version.php';
		}
		return self::$version;
	}

}
