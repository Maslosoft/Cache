<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\Cache\Adapters;

use Maslosoft\Cache\Interfaces\ICacheAdapter;

/**
 * Apc cache adapter
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class Apc implements ICacheAdapter
{

	public function get($key)
	{
		return apc_fetch($key);
	}

	public function has($key)
	{
		return apc_exists($key);
	}

	public function isAvailable()
	{
		return extension_loaded('apc') && ini_get('apc.enabled') == 1;
	}

	public function set($key, $data, $timeout = null)
	{
		apc_store($key, $data, $timeout);
	}

	public function clear()
	{
		apc_clear_cache();
	}

	public function remove($key)
	{
		apc_delete($key);
	}

}
