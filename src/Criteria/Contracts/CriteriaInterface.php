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
     * @param $attributeOrValueOne
     * @param $attributeOrValueTwo
     * @return $this
     */
    public function equal($attributeOrValueOne, $attributeOrValueTwo);

    /**
     * @param $attributeOrValueOne
     * @param $attributeOrValueTwo
     * @return $this
     */
    public function less($attributeOrValueOne, $attributeOrValueTwo);

    /**
     * @param $attributeOrValueOne
     * @param $attributeOrValueTwo
     * @return $this
     */
    public function greater($attributeOrValueOne, $attributeOrValueTwo);

}