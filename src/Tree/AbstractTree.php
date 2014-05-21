<?php namespace CobwebInfo\Cobra5Sdk\Tree;

use SoapFault;
use CobwebInfo\Cobra5Sdk\Entity\Category;
use CobwebInfo\Cobra5Sdk\Entity\Datastore;

abstract class AbstractTree {

  /**
   * Get the roots for a datastore
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Datastore $datastore
   * @return CobwebInfo\Cobra5Sdk\Entity\Datastore
   */
  protected function getRootCategoriesForDatastore(Datastore $datastore)
  {
    $response = $this->cobra5->getCategoriesForStore($datastore->id);

    return $response;
  }

  /**
   * Get the parent categories for a datastore
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Datastore $datastore
   * @return array
   */
  protected function getParentCategoriesForDatastore(Datastore $datastore)
  {
    $categories = [];

    foreach($datastore->roots() as $root)
    {
      $response = $this->cobra5->getCategory($root->id);

      foreach($response as $category)
      {
        $categories[$category->id] = $category;
      }
    }

    return $categories;
  }

  /**
   * Get the child categories for a category
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Category $category
   * @return Illuminate\Support\Collection
   */
  protected function getChildCategoriesForCategory(Category $category)
  {
    $response = $this->cobra5->getCategory($category->id);

    if(count($response) > 1)
    {
      return $response;
    }
  }

  /**
   * Get all documents for category
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Category $category
   * @return CobwebInfo\Cobra5Sdk\Entity\Category
   */
  protected function getDocumentsForCategory(Category $category)
  {
    try
    {
      $response = $this->cobra5->getDocumentsForCategory($category->id);

      return $response;
    }

    catch(SoapFault $e)
    {
      // Ignore the 404 SoapFault when
      // a category has no documents
    }
  }

  /**
   * Hydrate the root categories of a datastore
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Datastore $datastore
   * @return CobwebInfo\Cobra5Sdk\Entity\Datastore
   */
  protected function hydrateRoots(Datastore $datastore)
  {
    $categories = $this->getRootCategoriesForDatastore($datastore);

    foreach($categories as $category)
    {
      $datastore->addRoot($category);
    }

    return $datastore;
  }

  /**
   * Hydrate the parent categories of a datastore
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Datastore $datastore
   * @return CobwebInfo\Cobra5Sdk\Entity\Datastore
   */
  protected function hydrateParents(Datastore $datastore)
  {
    $categories = $this->getParentCategoriesForDatastore($datastore);

    foreach($categories as $category)
    {
      $datastore->addCategory($category);
    }

    return $datastore;
  }

  /**
   * Hydrate the children categories of a category
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Category $category
   * @return CobwebInfo\Cobra5Sdk\Entity
   */
  protected function hydrateChildren(Category $category)
  {
    $children = $this->getChildCategoriesForCategory($category);

    if($children)
    {
      foreach($children as $child)
      {
        $category->addChild($child);
      }
    }

    return $category;
  }

  /**
   * Hydrate the documents of a category
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Category $category
   * @return CobwebInfo\Cobra5Sdk\Entity\Category
   */
  protected function hydrateDocuments(Category $category)
  {
    if($category->hasChildren())
    {
      foreach($category->children() as $child)
      {
        $documents = $this->getDocumentsForCategory($child);

        if($documents)
        {
          foreach($documents as $document)
          {
            $child->addDocument($document);
          }
        }
      }

      return $category;
    }

    $documents = $this->getDocumentsForCategory($category);

    if($documents)
    {
      foreach($documents as $document)
      {
        $category->addDocument($document);
      }
    }

    return $category;
  }

}
