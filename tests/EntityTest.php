<?php

use Support\EntityStub;

class EntityTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributeCanBeAccessedThroughClassProperty()
    {
        $entity = new EntityStub(['name' => 'Hello world']);
        $this->assertEquals('Hello world', $entity->name);
    }

    public function testInvalidPropertyGetterCallThrowsException()
    {
        $this->expectException(Exception::class);
        $entity = new EntityStub;
        $entity->i_dont_exist;
    }

    public function testValidAttributesCanBeDynamicallySet()
    {
        $entity = new EntityStub;
        $entity->name = 'Hello world';
        $this->assertEquals('Hello world', $entity->name);
    }

    public function testOnlyFillableAttributesCanBeFilled()
    {
        $this->expectException(Exception::class);
        $entity = new EntityStub(['rogue' => 'im_not_allowed']);
        $entity->rogue;
    }

    public function testOnlyFillabelAttribtutesCanBeDynamicallySet()
    {
        $this->expectException(Exception::class);
        $entity = new EntityStub;
        $entity->rogue = 'im_not_allowed';
    }

    public function testArrayKeysAreTransformedToSnakeCase()
    {
        $entity = new EntityStub(['documentType' => 'PDF']);
        $this->assertEquals('PDF', $entity->document_type);
    }

    public function testToArrayReturnsArray()
    {
        $entity = new EntityStub(['name' => 'Hello world']);
        $this->assertTrue(is_array($entity->toArray()));
    }

    public function testToJsonReturnsJson()
    {
        $entity = new EntityStub(['name' => 'Hello world']);
        $this->assertEquals('{"name":"Hello world"}', $entity->toJson());
    }

    public function testToStringMagicMethodReturnsString()
    {
        $entity = new EntityStub(['name' => 'Hello world']);
        $this->assertEquals('{"name":"Hello world"}', (string)$entity);
    }
}
