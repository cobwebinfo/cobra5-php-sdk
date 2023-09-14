<?php

use CobwebInfo\Cobra5Sdk\Entity\Datastore;

class DatastoreTest extends \PHPUnit\Framework\TestCase
{
    public function testRootsMethodReturnsCollection()
    {
        $datastore = new Datastore;
        $this->assertInstanceOf('Illuminate\Support\Collection', $datastore->roots());
    }

    public function testAddRootOnlyAcceptsCategoryEntity()
    {
        $this->expectException(TypeError::class);

        $datastore = new Datastore;
        $datastore->addRoot('hello world');
    }

    public function testCategoriesMethodReturnsCollection()
    {
        $datastore = new Datastore;
        $this->assertInstanceOf('Illuminate\Support\Collection', $datastore->categories());
    }

    public function testAddCategoriesOnlyAcceptsCategoryEntity()
    {
        $this->expectException(TypeError::class);

        $datastore = new Datastore;
        $datastore->addCategory('hello world');
    }

    public function testDocumentsMethodReturnsCollection()
    {
        $datastore = new Datastore;
        $this->assertInstanceOf('Illuminate\Support\Collection', $datastore->documents());
    }

    public function testAddDocumentOnlyAcceptsDocumentEntity()
    {
        $datastore = new Datastore;

        $this->expectException(TypeError::class);

        $datastore->addDocument('hello world');
    }

}
