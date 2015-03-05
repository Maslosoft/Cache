<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
