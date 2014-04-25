<?php namespace CobwebInfo\Cobra5Sdk\Authentication;

class SoapApiKeyAuthentication implements SoapAuthentication {

  /**
   * The name of the SoapHeader
   *
   * @var string
   */
  protected $name;

  /**
   * The API key
   *
   * @var string
   */
  protected $api_key;

  /**
   * Create a new instance of the SoapApiKeyAuthentication
   *
   * @param string $name
   * @param string $api_key
   */
  public function __construct($name, $api_key)
  {
    $this->name     = $name;
    $this->api_key  = $api_key;
  }

  /**
   * Get the name of the SoapHeader
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Get the SoapHeader data
   *
   * @return array
   */
  public function getData()
  {
    return ['api_key' => $this->api_key];
  }

}
