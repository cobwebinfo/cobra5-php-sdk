<?php

use CobwebInfo\Cobra5Sdk\Entity\Category;

class CategoryEntityTest extends PHPUnit_Framework_TestCase {

  public function testIsDeletedReturnsBoolean()
  {
    $category = new Category(['deleted' => 1]);
    $this->assertTrue($category->isDeleted());
  }

}
