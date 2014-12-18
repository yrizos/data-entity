<?php

namespace DataEntity;

interface TypeInterface
{

    public function filter($value, $filter = null);

    public function validate($value);

} 