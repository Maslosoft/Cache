<!--header-->
<!-- Auto generated do not modify between `header` and `/header` -->

# <a href="http://maslosoft.com/cache/">Maslosoft Cache</a>
<a href="http://maslosoft.com/cache/">_Easy to use, auto configurable, extensible cache provider_</a>

<a href="https://packagist.org/packages/maslosoft/cache" title="Latest Stable Version">
<img src="https://poser.pugx.org/maslosoft/cache/v/stable.svg" alt="Latest Stable Version" style="height: 20px;"/>
</a>
<a href="https://packagist.org/packages/maslosoft/cache" title="License">
<img src="https://poser.pugx.org/maslosoft/cache/license.svg" alt="License" style="height: 20px;"/>
</a>
<img src="https://travis-ci.org/Maslosoft/Cache.svg?branch=master"/>
<img src="http://hhvm.h4cc.de/badge/maslosoft/cache.svg?style=flat"/>

### Quick Install
```bash
composer require maslosoft/cache:"*"
```

<!--/header-->

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
	
Setup cache. After calling `init` any further instance will be configured same as below `$cache`.
	
	use Maslosoft\Cache\Cache;
	
    $cache = new Cache();
	// Setup something here...
	$cache->timeout = 1244;
	$cache->init();

## Basic Usage

	<?php
	
	use Maslosoft\Cache\Cache;
	
    $cache = new Cache();
	
	// Init configuration, now it is available anywhere
	// By default it will try some cache providers and select best available.
	$cache->init();
	
	$key = 1;
	
	if(!$cache->has($key))
	{
		$cache->set($key, 'Some value');
	}
	
	echo $cache->get($key);


And that's it!


## Resources

 * [Project website](http://maslosoft.com/cache/)
 * [Project Page on GitHub](https://github.com/Maslosoft/Cache)
 * [Report a Bug](https://github.com/Maslosoft/Cache/issues)