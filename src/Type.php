<?php

namespace DataEntity;

abstract class Type implements TypeInterface
{

    /**
     * @param mixed $value
     * @param mixed|null $filter
     * @return mixed
     */
    abstract function filter($value, $context = null);

    /**
     * @param $value
     * @return bool
     */
    abstract function validate($value);

    /**
     * Builds type objects
     *
     * @param string|TypeInterface $type
     * @return TypeInterface
     * @throws \InvalidArgumentException
     */
    public static function factory($type)
    {
        if ($type instanceof TypeInterface) return $type;

        if (strpos($type, "\\") === false) {
            $type = ucfirst(trim(strval($type)));
            if (strripos(strrev($type), strrev('type')) === false) $type .= 'Type';

            $type = "DataEntity\\Type\\" . $type;
        }

        if (
            !class_exists($type)
            || !in_array("DataEntity\\TypeInterface", class_implements($type))
        ) throw new \InvalidArgumentException('Type ' . $type . ' is invalid.');

        return new $type;
    }
} 