<?php
namespace Ftob\LeaderBoardBundle\Repositories\Contracts;

use Ftob\LeaderBoardBundle\Criteria\Contracts\CriteriaInterface;

interface RepositoryInterface
{
    public function findAll();

    public function find($id);

    public function findBy($attribute, $value);

    public function findByCriteria(CriteriaInterface $criteria);

}