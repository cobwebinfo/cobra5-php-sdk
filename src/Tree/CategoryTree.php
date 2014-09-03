<?php namespace CobwebInfo\Cobra5Sdk\Tree;

use CobwebInfo\Cobra5Sdk\Cobra5;
use Illuminate\Support\Collection;
use CobwebInfo\Cobra5Sdk\Entity\Category;

class CategoryTree extends AbstractTree implements Tree {

  /**
   * The Cobra5 instance
   *
   * @var CobwebInfo\Cobra5Sdk\Cobra5
   */
  protected $cobra5;

  /**
   * Create a new instance of the DatastoreTree
   *
   * @param CobwebInfo\Cobra5Sdk\Cobra5
   * @return void
   */
  public function __construct(Cobra5 $cobra5)
  {
    $this->cobra5 = $cobra5;
  }

  /**
   * Create a tree of all branches
   *
   * @param array $selected
   * @param array $branches
   * @return Illuminate\Support\Collection
   */
  public function all(array $selected, array $branches = [])
  {
    $results = $this->cobra5->getStores();

    foreach($results as $result)
    {
      if(in_array($result->name, $selected))
      {
        $datastores[] = $result;
      }
    }

    foreach($datastores as $datastore)
    {
      $datastore = $this->hydrateRoots($datastore);
    }

    foreach($datastores as $datastore)
    {
      $datastore = $this->hydrateParents($datastore);
    }

    $categories = new Collection;

    foreach($datastores as $datastore)
    {
      foreach($datastore->categories() as $category)
      {
        $categories->put($category->id, $category);
      }
    }

    foreach($categories as $category)
    {
      $category = $this->hydrateChildren($category);
    }

    if(in_array('documents', $branches))
    {
      foreach($categories as $category)
      {
        $category = $this->hydrateDocuments($category);
      }
    }

    return $categories;
  }

  /**
   * Create a tree of a single branch
   *
   * @param array $branches
   * @return CobwebInfo\Cobra5Sdk\Entity\Entity
   */
  public function branch($id, array $branches = [])
  {
    $response = $this->cobra5->getCategory($id);

    if($response instanceOf Category)
    {
      $response = $this->hydrateChildren($response);

      if(in_array('documents', $branches))
      {
        $response = $this->hydrateDocuments($response);
      }

      return $response;
    }

    if($response instanceOf Collection)
    {
      foreach($response as $category)
      {
        $category = $this->hydrateChildren($category);
      }

      if(in_array('documents', $branches))
      {
        foreach($response as $category)
        {
          $category = $this->hydrateDocuments($category);
        }
      }

      return $response;
    }
  }

}
