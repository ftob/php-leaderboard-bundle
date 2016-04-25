<?php
namespace  Ftob\LeaderBoardBundle\Criteria\Contracts;

use Illuminate\Support\Collection;

/**
 * Interface CriteriaInterface
 * @package Ftob\LeaderBoardBundle\Criteria\Contracts
 */
interface CriteriaInterface
{
    /**
     * @return $this
     */
    public static function build();

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function apply(Collection $collection);

    /**
     * @param $attributeOrValue
     * @param $attributeOrValue
     * @return $this
     */
    public function equal($attributeOrValue, $attributeOrValue);

    /**
     * @param $attributeOrValue
     * @param $attributeOrValue
     * @return $this
     */
    public function less($attributeOrValue, $attributeOrValue);

    /**
     * @param $attributeOrValue
     * @param $attributeOrValue
     * @return $this
     */
    public function greater($attributeOrValue, $attributeOrValue);

}