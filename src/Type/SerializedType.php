<?php

namespace DataEntity\Type;

use DataEntity\Type;

class SerializedType extends Type
{

    public function filter($value, $context = null)
    {
        if (is_string($value) && $value != 'b:0;') {
            $data = @unserialize($value);

            if ($data !== false) return $value;
        }

        return serialize($value);
    }

    public function validate($value)
    {
        return
            is_scalar($value)
            || is_array($value)
            || (is_object($value) && !($value instanceof \Closure));
    }

} 