<?php

namespace DataEntityTest\Entity;

use DataEntity\Entity;

class Test extends Entity
{

    public static function fields()
    {
        return [
            'id'     => ['type' => 'integer'],
            'date'   => ['type' => 'datetime', 'default' => new \DateTime()],
            'string' => ['type' => 'string'],
            'email'  => ['type' => 'email'],
        ];
    }

} 