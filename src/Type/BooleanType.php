<?php

namespace DataEntity\Type;

use DataEntity\Type;
use Filterus\Filter;

class BooleanType extends Type
{

    public function filter($value, $context = null)
    {
        return Filter::factory('bool')->filter($value);
    }

    public function validate($value)
    {
        return !is_null($value) && Filter::factory('bool')->validate($value);
    }

} 