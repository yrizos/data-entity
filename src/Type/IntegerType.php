<?php

namespace DataEntity\Type;

use DataEntity\Type;
use Filterus\Filter;

class IntegerType extends Type
{
    public function filter($value, $context = null)
    {
        return Filter::factory('int')->filter($value);
    }

    public function validate($value)
    {
        return !is_bool($value) && Filter::factory('int')->validate($value);
    }
}