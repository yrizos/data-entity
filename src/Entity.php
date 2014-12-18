<?php

namespace DataEntity;

use DataObject\DataObject;

abstract class Entity extends DataObject implements EntityInterface
{
    /** @var bool */
    private $modified = false;

    /** @var null */
    private $fields = null;

    /** @var array */
    private $required = [];

    /**
     * @param string $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        $offset = trim(strval($offset));
        $value  = parent::offsetGet($offset);
        $value  = $this->getField($offset)->filter($value);

        return $value;
    }

    /**
     * @param string $offset
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value)
    {
        $offset = trim(strval($offset));

        if (!$this->getField($offset)->validate($value)) throw new \InvalidArgumentException($offset . ' validation failed.');
        if ($value !== parent::offsetGet($offset)) $this->modified = true;

        parent::offsetSet($offset, $value);
    }

    /**
     * @return array
     */
    public function getFields()
    {
        if (null === $this->fields) {
            $this->fields = [];
            $definition   = is_array(static::fields()) ? static::fields() : [];

            foreach ($definition as $key => $field) {
                if (is_string($key) && is_array($field)) {
                    $type     = isset($field['type']) ? $field['type'] : 'raw';
                    $default  = isset($field['default']) ? $field['default'] : null;
                    $required = isset($field['required']) && ($field['required'] !== false);
                    $field    = new Field($key, $type, $default, $required);
                }

                if ($field instanceof FieldInterface) {
                    $this->fields[$field->getName()] = $field;

                    if ($field->getRequired()) $this->required[] = $field->getName();

                    parent::offsetSet($field->getName(), $field->getDefault());
                }
            }

            $this->required = array_unique($this->required);
        }

        return $this->fields;
    }

    /**
     * @param string $offset
     * @return FieldInterface
     */
    public function getField($offset)
    {
        return
            isset($this->getFields()[$offset])
                ? $this->getFields()[$offset]
                : new Field($offset, 'raw', null, false);
    }

    /**
     * @return bool
     */
    final public function isModified()
    {
        return $this->modified === true;
    }

    /**
     * @return array
     */
    public function keys()
    {
        return array_keys(parent::getData());
    }

    /**
     * @return array
     */
    public function getData()
    {
        $offsets = $this->keys();
        $data    = [];

        foreach ($offsets as $offset) {
            $data[$offset] = $this->offsetGet($offset);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getRawData()
    {
        $offsets = $this->keys();
        $data    = parent::getData();

        foreach ($offsets as $offset) {
            if (!isset($data[$offset])) $data[$offset] = null;
        }

        return $data;
    }

    abstract static function fields();
} 