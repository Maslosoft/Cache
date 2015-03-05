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

namespace Maslosoft\Cache\Interfaces;

/**
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
interface ICache
{

	/**
	 * Check if cache has key
	 * @param string $key
	 */
	public function has($key);

	/**
	 * Get cached object
	 * @param string $key
	 * @return mixed
	 */
	public function get($key);

	/**
	 * Add or replace data to cache
	 * @param string $key
	 * @param mixed $data
	 * @param int|null $timeout Timeout in seconds. Set to null to use default. Set to 0 to disable timeout.
	 */
	public function set($key, $data, $timeout = null);

	/**
	 * Remove key from cache
	 * @param string $key
	 */
	public function remove($key);

	/**
	 * Clear all cache values
	 */
	public function clear();
}
