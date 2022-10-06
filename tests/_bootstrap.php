<?php

use Maslosoft\Cache\Cache;

date_default_timezone_set('Europe/Paris');

$cache = Cache::fly();

echo "Cache: " . $cache->getVersion();