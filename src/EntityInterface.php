<?php

namespace DataEntity;

use DataObject\DataObjectInterface;

interface EntityInterface extends DataObjectInterface
{
    public function getFields();

    public function getField($offset);

    public function isModified();

    public function keys();

    public function getRawData();

    public static function fields();
} 