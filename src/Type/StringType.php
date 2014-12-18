<?php

namespace DataEntity\Type;

use DataEntity\Type;
use Filterus\Filter;

class StringType extends Type
{
    public function filter($value, $context = null)
    {
        return Filter::factory('string,min:1')->filter($value);
    }

    public function validate($value)
    {
        return !is_bool($value) && Filter::factory('string,min:1')->validate($value);
    }
} 