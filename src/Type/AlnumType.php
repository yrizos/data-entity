<?php

namespace DataEntity\Type;

use DataEntity\Type;
use Filterus\Filter;

class AlnumType extends Type
{
    public function filter($value, $context = null)
    {
        return Filter::factory('alnum,min:1')->filter($value);
    }

    public function validate($value)
    {
        return Filter::factory('alnum,min:1')->validate($value);
    }
} 