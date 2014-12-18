<?php

namespace DataEntity\Type;

use DataEntity\Type;
use Filterus\Filter;

class FloatType extends Type
{

    public function filter($value, $context = null)
    {
        return Filter::factory('float')->filter($value);
    }

    public function validate($value)
    {
        return Filter::factory('float')->validate($value);
    }

} 