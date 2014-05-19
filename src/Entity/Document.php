<?php namespace CobwebInfo\Cobra5Sdk\Entity;

use Illuminate\Support\Contracts\JsonableInterface;
use Illuminate\Support\Contracts\ArrayableInterface;

class Document extends Entity implements ArrayableInterface, JsonableInterface {

  /**
   * The attributes that can be filled
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'name',
    'description',
    'version',
    'published',
    'document_type',
    'creation_date',
    'last_activation_date',
    'last_deactivation_date',
    'api_last_update_time',
    'document_id',
    'publish_date',
    'amended_date'
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
  }

  /**
   * Is the document published?
   *
   * @return bool
   */
  public function isPublished()
  {
    return $this->attributes['published'];
  }

}
