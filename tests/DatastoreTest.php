<?php

use CobwebInfo\Cobra5Sdk\Entity\Datastore;

class DatastoreEntityTest extends PHPUnit_Framework_TestCase {

  public function testRootsMethodReturnsCollection()
  {
    $datastore = new Datastore;
    $this->assertInstanceOf('Illuminate\Support\Collection', $datastore->roots());
  }

  /**
   * @expectedException Exception
   */
  public function testAddRootOnlyAcceptsCategoryEntity()
  {
    $datastore = new Datastore;
    $datastore->addRoot('hello world');
  }

  public function testCategoriesMethodReturnsCollection()
  {
    $datastore = new Datastore;
    $this->assertInstanceOf('Illuminate\Support\Collection', $datastore->categories());
  }

  /**
   * @expectedException Exception
   */
  public function testAddCategoriesOnlyAcceptsCategoryEntity()
  {
    $datastore = new Datastore;
    $datastore->addCategory('hello world');
  }

  public function testDocumentsMethodReturnsCollection()
  {
    $datastore = new Datastore;
    $this->assertInstanceOf('Illuminate\Support\Collection', $datastore->documents());
  }

  /**
   * @expectedException Exception
   */
  public function testAddDocumentOnlyAcceptsDocumentEntity()
  {
    $datastore = new Datastore;
    $datastore->addDocument('hello world');
  }

}
