<?php
namespace Ftob\LeaderBoardBundle\Repositories\Http;

use Ftob\LeaderBoardBundle\Criteria\Contracts\CriteriaInterface;
use Ftob\LeaderBoardBundle\Repositories\Contracts\CacheableInterface;
use Ftob\LeaderBoardBundle\Repositories\Contracts\CacheConfig;
use Ftob\LeaderBoardBundle\Repositories\Contracts\HttpConnection;
use Ftob\LeaderBoardBundle\Repositories\Contracts\RepositoryInterface;
use Ftob\LeaderBoardBundle\Repositories\Traits\CacheTrait;
use GuzzleHttp\Client;
use Illuminate\Cache\Repository;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpRepository
 * @package Ftob\LeaderBoardBundle\Repositories\Http
 */
class HttpRepository implements RepositoryInterface, CacheableInterface
{
    use CacheTrait;

    /** @var  HttpConnection */
    protected $connection;
    /** @var  CacheConfig */
    protected $cacheConfig;
    /** @var  Client */
    protected $client;
    /** @var  Repository */
    protected $cache;

    protected $isCache;

    public function __construct(HttpConnection $connection, Client $client,  CacheConfig $config = null)
    {
        $this->connection = $connection;
        $this->client = $client;

        // Cache config
        if ($config) {
            $this->setStore($config->getStore());
            $this->cache()->setDefaultCacheTime($config->getTtl());
            $this->isCache = true;
        }

    }

    /**
     * @return Collection
     */
    public function findAll()
    {
        if ($this->isCache) {
            $cacheKey = $this->cacheConfig->getPrefix()
                ? $this->cacheConfig->getPrefix() . '_' . $this->getCacheKey() : $this->getCacheKey();

            if ($this->cache()->has($cacheKey)) {
                return new Collection($this->cache()->get($cacheKey));
            }
        }
        /** @var ResponseInterface $response */
        $response = $this->responseHandler($this->client->get($this->connection->getUrl()));

        if ($this->isCache) {
            $this->cache()->put($cacheKey, $response);
        }
        return new Collection($response);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $items = $this->findAll();
        $item = $items->filter(function($value) use ($id){
            return $value->id === $id;
        });

        return $item;
    }

    /**
     * @param $attribute
     * @param $value
     * @return Collection|mixed
     */
    public function findBy($attribute, $value)
    {
        $items = $this->findAll();
        $items = $items->filter(function($item) use ($attribute, $value){
            return $item->{$attribute} === $value;
        });

        return $items;
    }

    /**
     * @param CriteriaInterface $criteria
     * @return Collection
     */
    public function findByCriteria(CriteriaInterface $criteria)
    {
        return $criteria->apply($this->findAll());
    }

    /**
     * @param ResponseInterface $responseInterface
     * @return ResponseInterface
     */
    protected function responseHandler(ResponseInterface $responseInterface)
    {
        // Response handle
        return $responseInterface;
    }


    public function getCacheKey()
    {
        // Set cache key, now is  default
        return 'http-repository-cache';
    }


}