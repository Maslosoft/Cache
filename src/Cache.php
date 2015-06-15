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
use Maslosoft\Cache\Adapters\StaticVar;
use Maslosoft\Cache\Helpers\AdapterFactory;
use Maslosoft\Cache\Interfaces\CacheInterface;
use Maslosoft\Cache\Interfaces\CacheAdapterInterface;
use Maslosoft\EmbeDi\EmbeDi;

/**
 * Cache
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Cache implements CacheInterface
{

	/**
	 * Adapters configuration
	 * @var mixed[]
	 */
	public $adapters = [
		Apc::class => true,
		StaticVar::class => true,
	];

	/**
	 * Default cache timeout
	 * @var int
	 */
	public $timeout = 600;

	/**
	 *
	 * @var CacheInterface
	 */
	private $_adapter = null;

	/**
	 *
	 * @var EmbeDi
	 */
	private $_di = null;

	public function __construct($instanceId = 'cache')
	{
		$this->_di = new EmbeDi($instanceId);
		$this->_di->configure($this);
	}

	public function init()
	{
		$this->_di->store($this);
	}

	public function get($key)
	{
		return $this->getAdapter()->get($key);
	}

	public function has($key)
	{
		return $this->getAdapter()->has($key);
	}

	public function set($key, $data, $timeout = null)
	{
		if (null === $timeout)
		{
			$timeout = $this->timeout;
		}
		return $this->getAdapter()->set($key, $data, $timeout);
	}

	public function clear()
	{
		return $this->getAdapter()->clear();
	}

	public function remove($key)
	{
		return $this->getAdapter()->remove($key);
	}

	/**
	 * Get cache adapter
	 * @return CacheAdapterInterface
	 */
	private function getAdapter()
	{
		if (null === $this->_adapter)
		{
			$this->_adapter = AdapterFactory::create($this->adapters, $this);
		}
		return $this->_adapter;
	}

}
