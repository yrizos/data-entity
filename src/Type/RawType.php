<?php

namespace DataEntity\Type;

use DataEntity\Type;

class RawType extends Type
{

    public function filter($value, $context = null)
    {
        return $value;
    }

    public function validate($value)
    {
        return true;
    }


} 