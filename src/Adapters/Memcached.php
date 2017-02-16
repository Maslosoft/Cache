<?php

namespace Maslosoft\Cache\Adapters;

use Maslosoft\Cache\Interfaces\CacheAdapterInterface;
use Memcached as Mc;

/**
 * Memcached adapter.
 *
 * NOTE: There is memcache and memcached php extensions.
 * This adapter requires memcached extension, which offers more fatures.
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Memcached implements CacheAdapterInterface
{

	/**
	 *
	 * @var Mc
	 */
	private $mc = null;
	public $servers = [
		'localhost:11211'
	];

	public function __construct()
	{
		if (!class_exists(Mc::class))
		{
			return;
		}
		$this->mc = new Mc();
		foreach ($this->servers as $connectionString)
		{
			list($host, $port) = explode(':', $connectionString);
			$this->mc->addServer($host, $port);
		}
	}

	public function clear()
	{
		return $this->mc->flush();
	}

	public function get($key)
	{
		return $this->mc->get($key);
	}

	public function has($key)
	{
		$this->mc->get($key);
		return Mc::RES_NOTFOUND !== $this->mc->getResultCode();
	}

	public function remove($key)
	{
		return $this->mc->delete($key);
	}

	public function set($key, $data, $timeout = null)
	{
		return $this->mc->set($key, $data, $timeout);
	}

	public function isAvailable()
	{
		return extension_loaded('memcached');
	}

}
