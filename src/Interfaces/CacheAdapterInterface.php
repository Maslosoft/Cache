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
interface CacheAdapterInterface extends CacheInterface
{

	/**
	 * Return true if this adapter is available
	 * @return bool Cache adapter availability
	 */
	public function isAvailable();
}
