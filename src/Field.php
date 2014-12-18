<?php

namespace DataEntity;

class Field implements FieldInterface
{
    /** @var string */
    private $name;

    /** @var TypeInterface */
    private $type;

    /** @var mixed */
    private $default = null;

    /** @var bool */
    private $required = true;

    public function __construct($name, $type = 'raw', $default = null, $required = true)
    {
        $name = is_string($name) ? trim($name) : null;
        if (empty($name)) throw new \InvalidArgumentException("Name can't be empty.");

        $this->name     = $name;
        $this->type = Type::factory($type);
        $this->default  = $default;
        $this->required = $required === true;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return bool
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param $value
     * @param string|null $filter
     * @return mixed
     */
    public function filter($value, $context = null)
    {
        return $this->getType()->filter($value, $context);
    }

    /**
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        return
            (
                $value !== null
                && $value === $this->getDefault()
            )
            || $this->getType()->validate($value);
    }

} 