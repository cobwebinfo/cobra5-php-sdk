<?php

use CobwebInfo\Cobra5Sdk\Entity\Category;

class CategoryEntityTest extends PHPUnit_Framework_TestCase {

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

  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testAddChildOnlyAcceptsCategoryEntity()
  {
    $category = new Category;
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

  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testAddDocumentOnlyAcceptsDocumentEntity()
  {
    $category = new Category;
    $category->addDocument('hello world');
  }

}
