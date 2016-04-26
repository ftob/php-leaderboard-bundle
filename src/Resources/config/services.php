<?php

use Ftob\LeaderBoardBundle\Repositories\Contracts\CacheConfig;
use Ftob\LeaderBoardBundle\Repositories\Contracts\HttpConnection;
use Ftob\LeaderBoardBundle\Repositories\LeaderRepository;
use Ftob\LeaderBoardBundle\Services\LeaderService;
use Ftob\LeaderBoardBundle\Services\Statistics;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

$container->setDefinition('leaderboard.url', new Definition(\GuzzleHttp\Psr7\Uri::class, ['%board.url%']));
$container->setDefinition('leaderboard.client', new Definition(\GuzzleHttp\Client::class, []));

$container->setDefinition(
    'leaderboard.connect',
    new Definition(HttpConnection::class, [new Reference('leaderboard.url')])
);

$container->setDefinition(
    'leaderboard.cache.store',
    new Definition(\Illuminate\Cache\FileStore::class, [
        new \Illuminate\Filesystem\Filesystem(), '%board.cache.dir%'
    ])
);

$container->setDefinition('leaderboard.repository.cache', new Definition(CacheConfig::class, [
    new Reference('leaderboard.cache.store'), '%board.cache.ttl%', '%board.cache.prefix%'
]));

$container->setDefinition(
    'leaderboard.repository', new Definition(LeaderRepository::class, [
        new Reference('leaderboard.connect'),
        new Reference('leaderboard.client'),
        new Reference('leaderboard.repository.cache')
    ])
);

$container->setDefinition('leaderboard.statistics', new Definition(Statistics::class, [

]));

$container->setDefinition(
    'leaderboard.service',
    new Definition(
        LeaderService::class,
        [
            new Reference('leaderboard.repository'), new Reference('leaderboard.statistics')
        ])
);
