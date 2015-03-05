<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\Cache\Adapters;

use Maslosoft\Cache\Interfaces\ICacheAdapter;

/**
 * Static
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class StaticVar implements ICacheAdapter
{

	private static $_values = [];
	private static $_ttls = [];

	public function get($key)
	{
		if ($this->has($key))
		{
			return self::$_values[$key];
		}
		return null;
	}

	public function has($key)
	{
		return array_key_exists($key, self::$_values);
	}

	public function isAvailable()
	{
		return true;
	}

	public function set($key, $data, $timeout = null)
	{
		
	}

	public function clear()
	{

	}

	public function remove($key)
	{

	}

}
