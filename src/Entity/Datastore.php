<?php namespace CobwebInfo\Cobra5Sdk\Entity;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;

class Datastore extends Entity implements Arrayable, Jsonable {

  /**
   * The attributes that can be filled
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'name',
    'description',
    'last_mod_date',
    'creation_date',
    'api_last_update_time',
    'categories'
  ];

  /**
   * Create a new Datastore entity
   *
   * @param array $data
   * @return void
   */
  public function __construct(array $data = [])
  {
    $this->fill($data);

    $this->relations = [
      'roots'      => new Collection,
      'categories'  => new Collection,
      'documents'   => new Collection
    ];
  }

  /**
   * Get the Datastore's root categories
   *
   * @return Collection
   */
  public function roots()
  {
    return $this->relations['roots'];
  }

  /**
   * Add a root category to the datastore
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Category $category
   * @return void
   */
  public function addRoot(Category $category)
  {
    $this->relations['roots']->put($category->id, $category);
  }

  /**
   * Get all of the categories of the datastore
   *
   * @return Illuminate\Support\Collection
   */
  public function categories()
  {
    return $this->relations['categories'];
  }

  /**
   * Add a category to the datastore
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Category $category
   * @return void
   */
  public function addCategory(Category $category)
  {
    $this->relations['categories']->put($category->id, $category);
  }

  /**
   * Get all of the documents of the datastore
   *
   * @return Illuminate\Support\Collection
   */
  public function documents()
  {
    return $this->relations['documents'];
  }

  /**
   * Add a document to the datastore
   *
   * @param CobwebInfo\Cobra5Sdk\Entity\Document $document
   * @return void
   */
  public function addDocument(Document $document)
  {
    $this->relations['documents']->put($document->id, $document);
  }

}
