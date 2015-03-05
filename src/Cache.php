<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\Cache;

use Maslosoft\Cache\Adapters\Apc;
use Maslosoft\Cache\Helpers\AdapterFactory;
use Maslosoft\Cache\Interfaces\ICache;
use Maslosoft\Cache\Interfaces\ICacheAdapter;
use Maslosoft\EmbeDi\EmbeDi;

/**
 * Cache
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Cache implements ICache
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
	 * @var ICache
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
		$this->getAdapter()->has($key);
	}

	public function set($key, $data, $timeout = null)
	{
		if (null === $timeout)
		{
			$timeout = $this->timeout;
		}
		$this->getAdapter()->set($key, $data, $timeout);
	}

	public function clear()
	{
		$this->getAdapter()->clear();
	}

	public function remove($key)
	{
		$this->getAdapter()->remove($key);
	}

	/**
	 * Get cache adapter
	 * @return ICacheAdapter
	 */
	private function getAdapter()
	{
		if (null == $this->_adapter)
		{
			$this->_adapter = AdapterFactory::create($this->adapters, $this);
		}
		return $this->_adapter;
	}

}
