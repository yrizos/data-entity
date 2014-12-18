<?php

namespace DataEntity\Type;

use DataEntity\Type;
use Filterus\Filter;

class ArrayType extends Type
{

    public function filter($value, $context = null)
    {
        return Filter::factory('array')->filter($value);
    }

    public function validate($value)
    {
        return Filter::factory('array')->validate($value);
    }
} 