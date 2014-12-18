<?php

namespace DataEntity;

interface FieldInterface extends TypeInterface
{
    public function __construct($name, $type, $default = null, $required = true);

    public function getName();

    public function getType();

    public function getDefault();

    public function getRequired();

} 