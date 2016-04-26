<?php
// Url service
$container->setParameter('board.url', 'http://example.com/leaderboard');
// Store cache - dir
$container->setParameter('board.cache.dir', sys_get_temp_dir());

$container->setParameter('board.cache.ttl', 120);

$container->setParameter('board.cache.prefix', 'leaderboard');