<?php

namespace DataEntity;

interface TypeInterface
{

    public function filter($value, $context = null);

    public function validate($value);

} 