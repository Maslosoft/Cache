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
 * Implement this interface to get access to cache parent if any available.
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
interface IChildCache
{

	public function getParent();

	public function setParent(ICache $cache);
}
