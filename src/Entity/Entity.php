<?php namespace CobwebInfo\Cobra5Sdk\Entity;

use Exception;

abstract class Entity {

  /**
   * The entity's attributes
   *
   * @var array
   */
  protected $attributes = [];

  /**
   * The entity's relations
   *
   * @var array
   */
  protected $relations = [];

  /**
   * The entities fillable attributes
   *
   * @var array
   */
  protected $fillable = [];

  /**
   * The entities hidden attributes
   *
   * @var array
   */
  protected $hidden = [];

  /**
   * Fill the entity with an array of attributes.
   *
   * @param array $attributes
   */
  protected function fill(array $attributes)
  {
    foreach ($this->fillableFromArray($attributes) as $key => $value)
    {
      if ($this->isFillable($key))
      {
        $this->setAttribute($key, $value);
      }
    }
  }

  /**
   * Get the fillable attributes of a given array
   *
   * @param array $attributes
   * @return array
   */
  protected function fillableFromArray(array $attributes)
  {
    if (count($this->fillable) > 0)
    {
      $attributes = $this->transformKeysToSnakeCase($attributes);

      return array_intersect_key($attributes, array_flip($this->fillable));
    }

    return $attributes;
  }

  /**
   * Determine if the given attribute may be mass assigned
   *
   * @param string $key
   * @return bool
   */
  protected function isFillable($key)
  {
    if (in_array($key, $this->fillable)) return true;
  }

  /**
   * Set attribute on object
   *
   * @param string $key
   * @param string $mixed
   * @return void
   */
  protected function setAttribute($key, $value)
  {
    $this->attributes[$this->snakeCase($key)] = $value;
  }

  /**
   * Convert a string to its snake case representation
   *
   * @param string $string
   * @return string
   */
  protected function snakeCase($string)
  {
    return snake_case($string);
  }

  /**
   * Transform the keys of an array to snake case
   *
   * @param array $input
   * @return array
   */
  protected function transformKeysToSnakeCase(array $input)
  {
    $output = [];

    foreach($input as $key => $value)
    {
      $output[$this->snakeCase($key)] = $value;
    }

    return $output;
  }

  /**
   * Convert the entity to an array
   *
   * @return array
   */
  public function toArray()
  {
    $attributes = array_diff_key($this->attributes, array_flip($this->hidden));

    $relations = [];

    foreach($this->relations as $key => $relation)
    {
      $relations[$key] = $relation->toArray();
    }

    return array_merge($attributes, $relations);
  }

  /**
   * Convert the entity to JSON
   *
   * @param int $options
   * @return string
   */
  public function toJson($options = 0)
  {
    return json_encode($this->toArray(), $options);
  }

  /**
   * Dynamically get an attribute
   *
   * @param string $key
   * @return mixed
   */
  public function __get($key)
  {
    if(isset($this->attributes[$key]))
    {
      return $this->attributes[$key];
    }

    throw new Exception("{$key} is not a valid property");
  }

  /**
   * Dynamically set an attribute.
   *
   * @param string $key
   * @param mixed $value
   * @return mixed
   */
  public function __set($key, $value)
  {
    if($this->isFillable($key))
    {
      return $this->attributes[$key] = $value;
    }

    throw new Exception("{$key} is not a valid property");
  }

  /**
   * Convert the entity to its string representation
   *
   * @return string
   */
  public function __toString()
  {
    return $this->toJson();
  }

}
