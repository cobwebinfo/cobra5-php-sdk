<?php namespace CobwebInfo\Cobra5Sdk\Entity;

class Datastore extends Entity {

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
  }

}
