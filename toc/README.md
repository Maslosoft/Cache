#Maslosoft Cache

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Maslosoft/Cache/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Maslosoft/Cache/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Maslosoft/Cache/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Maslosoft/Cache/?branch=master)
<img src="https://travis-ci.org/Maslosoft/Cache.svg?branch=master" style="height:18px"/>

######Easy to use, auto configurable, extensible cache provider

If you need some modern cache with just basic features here it is.

It implements only basic cache operations:

 - has - to check if has key in cache
 - get - to get cached value by key
 - set - to set value to cache
 - remove - to remove cached value
 - clear - to clear entira cache
 
## Requirements

- PHP 5.6+
- composer

## Setup

Use composer to install extension:

	composer require maslosoft/cache:"*"

## Basic Usage

	<?php
	
	use Maslosoft\Cache\Cache;
	
    $cache = new Cache();
	
	// Init configuration, now it is available anywhere
	// By default it will try some cache providers and select best available.
	$cache->init();
	
	$id = 1;
	
	if(!$cache->has($id))
	{
		$cache->set($id, 'Some value');
	}
	
	echo $cache->get($id);


And that's it!


## Resources

 * [Project website](http://maslosoft.com/cache/)
 * [Project Page on GitHub](https://github.com/Maslosoft/Cache)
 * [Report a Bug](https://github.com/Maslosoft/Cache/issues)