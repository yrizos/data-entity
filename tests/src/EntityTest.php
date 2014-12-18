<?php

namespace DataEntityTest;

use DataEntity\Type;
use DataEntityTest\Entity\Test;

class EntityTest extends \PHPUnit_Framework_TestCase
{

    public function testFields()
    {
        $entity = new Test();
        $fields = $entity->getFields();

        $this->assertEquals(count($entity::fields()), count($fields));

        foreach ($fields as $field) {
            $this->assertInstanceOf("DataEntity\\FieldInterface", $field);
        }

        $this->assertInstanceOf("DateTime", $fields['date']->getDefault());
        $this->assertInstanceOf("DateTime", $entity['date']);
    }

    public function testOffsetGetSet()
    {
        $time   = time() + 60 * 60 * 24 * 30;
        $date   = new \DateTime('@' . $time);
        $string = date('Y-m-d H:i:s', $time);

        $entity         = new Test();
        $entity['date'] = $time;

        $this->assertInstanceOf("DateTime", $entity['date']);

        $entity['date'] = $date;

        $this->assertInstanceOf("DateTime", $entity['date']);

        $entity['date'] = $string;

        $this->assertInstanceOf("DateTime", $entity['date']);
        $this->assertEquals($string, $entity['date']->format('Y-m-d H:i:s'));
    }

    public function testKeys()
    {
        $entity = new Test();
        $fields = $entity->getFields();

        $this->assertEquals(array_keys($fields), $entity->keys());
        $this->assertNotContains('key', $entity->keys());

        $entity['key'] = 'value';

        $this->assertContains('key', $entity->keys());
    }

    public function testModified()
    {
        $entity = new Test();

        $this->assertFalse($entity->isModified());

        $entity['key'] = 'value';

        $this->assertTrue($entity->isModified());
    }

    public function testData()
    {
        $entity           = new Test();
        $entity['string'] = 1234;
        $entity['date']   = time();

        $data = $entity->getData();
        $raw  = $entity->getRawData();

        $this->assertEquals(count($raw), count($data));

        $this->assertInternalType('integer', $raw['string']);
        $this->assertInternalType('integer', $raw['date']);

        $this->assertInternalType('string', $data['string']);
        $this->assertInstanceOf('DateTime', $data['date']);

    }
} 