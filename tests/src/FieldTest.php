<?php

namespace DataEntityTest;

use DataEntity\Field;

class FieldTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $field = new Field('name', 'raw', 'default', false);

        $this->assertEquals('name', $field->getName());
        $this->assertEquals('default', $field->getDefault());
        $this->assertInstanceOf("DataEntity\\TypeInterface", $field->getType());
        $this->assertFalse($field->getRequired());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorException()
    {
        $field = new Field(null);
    }

} 