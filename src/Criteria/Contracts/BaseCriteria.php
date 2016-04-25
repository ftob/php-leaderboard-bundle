<?php
namespace Ftob\LeaderBoardBundle\Criteria\Contracts;

use Ftob\LeaderBoardBundle\Exceptions\CriteriaParametersException;
use Illuminate\Support\Collection;

/**
 * Class BaseCriteria
 * @package Ftob\LeaderBoardBundle\Criteria\Contracts
 */
class BaseCriteria implements CriteriaInterface
{
    const LESS = 'less';

    const EQUAL = 'equal';

    const GREATER = 'greater';

    protected $criteria = [];


    protected function init()
    {
        // Initial function
    }

    private function __construct()
    {
        $this->init();
    }

    public static function build()
    {
        return new static();
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function apply(Collection $collection)
    {
        if(!($collection->isEmpty()) && !(empty($this->criteria))) {
            foreach ($this->criteria as $key => $parameters) {
                // Парамментры могут быть пустыми
                if(empty($parameters)) {
                    continue;
                }
                // Фильтруем значение
                $collection = $collection->filter(function($value, $k) use ($key, $parameters) {
                    foreach ($parameters as $param) {
                        // Получем опреатор в зависимости от ключа
                        $exp = $this->getSign($key);

                        /** @var Parameters $param*/
                        if(count($param->getAttributes()) === 2) {
                            $attributes = $param->getAttributes();
                            return eval('return $value->{head($attributes)}' .  $exp . ' $value->{last($attributes)};');
                        } else if (count($param->getAttributes()) === 1 && !empty($param->getValue())) {

                            return eval('return $value->{head($param->getAttributes())} ' . $exp . ' $param->getValue();');
                        }

                    }
                    return false;
                });
            }
        }

        return $collection;
    }


    /**
     * @param $attributeOrValueOne
     * @param $attributeOrValueTwo
     * @param $key
     */
    protected function addCondition($attributeOrValueOne, $attributeOrValueTwo, $key)
    {
        $this->criteria[$key][] = new Parameters($attributeOrValueOne, $attributeOrValueTwo);
    }

    /**
     * @param $attributeOrValueOne
     * @param $attributeOrValueTwo
     * @return $this
     */
    public function equal($attributeOrValueOne, $attributeOrValueTwo)
    {
        $this->addCondition($attributeOrValueOne, $attributeOrValueTwo, self::EQUAL);
        return $this;
    }

    /**
     * @param $attributeOrValueOne
     * @param $attributeOrValueTwo
     * @return $this
     */
    public function less($attributeOrValueOne, $attributeOrValueTwo)
    {
        $this->addCondition($attributeOrValueOne, $attributeOrValueTwo, self::LESS);
        return $this;
    }

    /**
     * @param $attributeOrValueOne
     * @param $attributeOrValueTwo
     * @return $this
     */
    public function greater($attributeOrValueOne, $attributeOrValueTwo)
    {
        $this->addCondition($attributeOrValueOne, $attributeOrValueTwo, self::GREATER);
        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getSign($key)
    {
        $sign = [
            static::EQUAL => '===',
            static::LESS => '<',
            static::GREATER => '>',
        ];
        if (array_key_exists($key, $sign)) {
            return $sign[$key];
        }

        throw new CriteriaParametersException('Sign not found - ' . $key);
    }

}