<?php namespace CobwebInfo\Cobra5Sdk\Entity;

class Category extends Entity {

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
    'parent_id',
    'deleted',
    'api_last_update_time',
    'vyre_id',
    'document_count'
  ];

  /**
   * Create a new Category entity
   *
   * @param array $data
   * @return void
   */
  public function __construct(array $data = [])
  {
    $this->fill($data);
  }

  /**
   * Is the category deleted?
   *
   * @return bool
   */
  public function isDeleted()
  {
    return (bool) $this->attributes['deleted'];
  }

}
