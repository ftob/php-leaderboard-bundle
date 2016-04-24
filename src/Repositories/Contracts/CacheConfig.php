<?php
namespace Ftob\LeaderBoardBundle\Repositories\Contracts;

use Illuminate\Contracts\Cache\Store;

class CacheConfig {

    protected $store;

    protected $ttl;

    protected $prefix;

    /**
     * CacheConfig constructor.
     * @param Store $store
     * @param int $ttl
     * @param string $prefix
     */
    public function __construct(Store $store, $ttl = 120, $prefix = '')
    {
        $this->store = $store;
        $this->ttl = $ttl;
        $this->prefix = $prefix;
    }

    /**
     * @return Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param Store $store
     */
    public function setStore(Store $store)
    {
        $this->store = $store;
    }

    /**
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

}