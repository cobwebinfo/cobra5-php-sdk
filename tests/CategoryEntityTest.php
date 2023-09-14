<?php

use CobwebInfo\Cobra5Sdk\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryEntityTest extends TestCase {

    public function testIsDeletedReturnsBoolean()
    {
        $category = new Category(['deleted' => 1]);
        $this->assertTrue($category->isDeleted());
    }

    public function testChildrenMethodReturnsCollection()
    {
        $category = new Category;
        $this->assertInstanceOf('Illuminate\Support\Collection', $category->children());
    }

    public function testAddChildOnlyAcceptsCategoryEntity()
    {
        $category = new Category;

        $this->expectException(TypeError::class);

        $category->addChild('hello world');
    }

    public function testHasChildrenReturnsBool()
    {
        $category = new Category;
        $this->assertFalse($category->hasChildren());
        $child = new Category(['id' => 1]);
        $category->addChild($child);
        $this->assertTrue($category->hasChildren());
    }

    public function testDocumentsMethodReturnsCollection()
    {
        $category = new Category;
        $this->assertInstanceOf('Illuminate\Support\Collection', $category->documents());
    }

    public function testAddDocumentOnlyAcceptsDocumentEntity()
    {
        $category = new Category;
        $this->expectException(TypeError::class);
        $category->addDocument('hello world');
    }
}
