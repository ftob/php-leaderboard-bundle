<?php
namespace Ftob\LeaderBoardBundle\Repositories\Contracts;

interface CacheableInterface
{
    public function cache();

    public function getCacheKey();
}