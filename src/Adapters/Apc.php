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
use function extension_loaded;
use function ini_get;
use const PHP_SAPI;

/**
 * Apc and Apcu cache adapter
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Apc implements CacheAdapterInterface
{

	private bool $apcu;

	public function __construct()
	{
		// Whether to use APC or APCu
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

	public function isAvailable(): bool
	{
		$isLoaded = (extension_loaded('apc') || extension_loaded('apcu'));
		$isEnabled = ini_get('apc.enabled') == 1;
		if(PHP_SAPI === 'cli')
		{
			// APCu might be enabled on web but not enabled on CLI
			$isEnabled = $isEnabled && ini_get('apc.enable_cli') == 1;
		}
		return $isLoaded && $isEnabled;
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
