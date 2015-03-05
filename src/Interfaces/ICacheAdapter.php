<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\Cache\Interfaces;

/**
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
interface ICacheAdapter extends ICache
{

	/**
	 * Return true if this adapter is available
	 * @return bool Cache adapter availability
	 */
	public function isAvailable();
}
