<?php namespace CobwebInfo\Cobra5Sdk;

interface Cobra5Interface {

  /**
   * Get all the datastores for the current organisation
   *
   * @param boolean $forceGroup
   * @return array
   */
  public function getStores($forceGroup = true);

  /**
   * Get a single datastore by it's id
   *
   * @param int $id
   * @return array
   */
  public function getStore($id);

  /**
   * Get a single datastore by it's name
   *
   * @param string $name
   * @return array
   */
  public function getStoreByName($name);

  /**
   * Get all the documents for the current datastore
   *
   * @param int $store_id
   * @param array $filters
   * @return array
   */
  public function getDocuments($store_id = null, $filters = array());

  /**
   * Get a single document by it's id
   *
   * @param int $id
   * @return array
   */
  public function getDocument($id);

  /**
   * Get the last edited document
   *
   * @return array
   */
  public function getLastEditedDocument();

  /**
   * Get edited documents between two unix timestamps
   *
   * @param string $start
   * @param string $end
   * @return array
   */
  public function getEditedDocuments($start, $end);

  /**
   * Get the documents for a specific datastore
   *
   * @param int $store_id
   * @return array
   */
  public function getDocumentsByDataStore($datastore_id);

  /**
   * Get the documents for a specific category
   *
   * @param int $category_id
   * @param int $store_id
   * @return array
   */
  public function getDocumentsForCategory($category_id, $store_id = null);

  /**
   * Get a specific category by it's id
   *
   * @param int $category_id
   * @param int $store_id
   * @return array
   */
  public function getCategory($category_id, $store_id = null);

  /**
   * Get the categories for a specific datastore
   *
   * @param int $store_id
   * @return array
   */
  public function getCategoriesForStore($store_id);

  /**
   * Get the XML version of a document
   *
   * @param int $id
   * @return string
   */
  public function getDocumentXml($id);

  /**
   * Get the PDF version of a document
   *
   * @param int $id
   * @param int $datastore_id
   * @return string
   */
  public function getDocumentPdf($id, $datastore_id = null);

  /**
   * Get the HTML version of a document
   *
   * @param int $id
   * @param int $datastore_id
   * @return string
   */
  public function getDocumentHtml($id, $datastore_id = null);

  /**
   * Search the API for a particular term
   *
   * @param string $term
   * @param int $start
   * @param int $limit
   * @param string $type
   * @return array
   */
  public function documentSearch($term, $start = 0, $limit = 10, $type = false);

}
