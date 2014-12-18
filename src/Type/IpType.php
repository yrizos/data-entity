<?php

namespace DataEntity\Type;

use DataEntity\Type;
use Filterus\Filter;

class IpType extends Type
{
    public function filter($value, $context = null)
    {
        return Filter::factory('ip')->filter($value);
    }

    public function validate($value)
    {
        return Filter::factory('ip')->validate($value);
    }
} 