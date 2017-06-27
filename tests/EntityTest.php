<?php

class EntityTest extends PHPUnit_Framework_TestCase
{

    public function testAttributeCanBeAccessedThroughClassProperty()
    {
        $entity = new EntityStub(['name' => 'Hello world']);
        $this->assertEquals('Hello world', $entity->name);
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidPropertyGetterCallThrowsException()
    {
        $entity = new EntityStub;
        $entity->i_dont_exist;
    }

    public function testValidAttributesCanBeDynamicallySet()
    {
        $entity = new EntityStub;
        $entity->name = 'Hello world';
        $this->assertEquals('Hello world', $entity->name);
    }

    /**
     * @expectedException Exception
     */
    public function testOnlyFillableAttributesCanBeFilled()
    {
        $entity = new EntityStub(['rogue' => 'im_not_allowed']);
        $entity->rogue;
    }

    /**
     * @expectedException Exception
     */
    public function testOnlyFillabelAttribtutesCanBeDynamicallySet()
    {
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
