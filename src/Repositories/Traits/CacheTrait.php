<?php
namespace  Ftob\LeaderBoardBundle\Repositories\Traits;

use Illuminate\Cache\Repository;
use Illuminate\Contracts\Cache\Store;

trait CacheTrait
{
    /** @var  Repository */
    protected $cacheRepository;
    /** @var  Store */
    protected $store;

    /**
     * @param Store $store
     */
    private function buildCacheRepository(Store $store)
    {
        $this->cacheRepository = new Repository($store);
    }

    public function setStore(Store $store)
    {
        $this->store = $store;
        $this->buildCacheRepository($store);
    }


    public function cache()
    {
        if (!$this->cacheRepository) {
            if (!($this->store instanceof  Store)) {
                return false;
            }
            $this->buildCacheRepository($this->store);
        }
        return $this->cacheRepository;
    }
}