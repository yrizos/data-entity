<?php

namespace DataEntity\Type;

use DataEntity\Type;
use Filterus\Filter;

class EmailType extends Type
{

    public function filter($value, $context = null)
    {
        return Filter::factory('email')->filter($value);
    }

    public function validate($value)
    {
        return
            !is_bool($value)
            && Filter::factory('email')->validate($value);
    }
} 