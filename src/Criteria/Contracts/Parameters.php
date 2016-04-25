<?php
namespace Ftob\LeaderBoardBundle\Criteria\Contracts;

use Ftob\LeaderBoardBundle\Exceptions\CriteriaParametersException;

class Parameters
{
    protected $attributes;

    protected $value;

    public function __construct($attributeOrValueOne, $attributeOrValueTwo)
    {
        if ($attributeOrValueOne instanceof Attribute) {
            $this->attributes[] = $attributeOrValueOne;
        } else {
            $this->value = $attributeOrValueOne;
        }

        if ($attributeOrValueTwo instanceof Attribute) {
            $this->attributes[] = $attributeOrValueTwo;
        } else {
            $this->value = $attributeOrValueTwo;
        }

        if(empty($this->attributes)) {
            throw new CriteriaParametersException('One of parameters must be Attribute');
        }
    }


    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

}
