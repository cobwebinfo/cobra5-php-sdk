<?php namespace CobwebInfo\Cobra5Sdk\Client;

use SoapClient;
use SoapHeader;
use CobwebInfo\Cobra5Sdk\Cobra5Interface;
use CobwebInfo\Cobra5Sdk\Authentication\SoapAuthentication;

class Cobra5SoapClient implements Cobra5Interface
{

    /**
     * The SoapClient instance
     *
     * @var SoapClient
     */
    protected $client;

    /**
     * The SoapHeader instance
     *
     * @var SoapHeader
     */
    protected $header;

    /**
     * The Authentication object
     *
     * @var CobwebInfo\Cobra5Sdk\Authentication\SoapAuthentication
     */
    protected $auth;

    /**
     * The API endpoint
     *
     * @return string
     */
    protected $endpoint = 'http://api.cobwebinfo.com/server';

    /**
     * Create a new instance of Cobra5SoapClient
     *
     * @param SoapClient $client
     * @param CobwebInfo\Cobra5Sdk\Authentication\SoapAuthentication $auth
     * @return void
     */
    public function __construct(SoapClient $client, SoapAuthentication $auth)
    {
        $this->client = $client;
        $this->auth = $auth;
    }

    /**
     * Get the API endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Set the API endpoint
     *
     * @param string $endpoint
     * @return CobwebInfo\Cobra5Sdk\Client\Cobra5SoapClient
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Check if the header has been set
     *
     * @return bool
     */
    public function hasHeader()
    {
        return !is_null($this->header);
    }

    /**
     * Set the header if it has not been set
     *
     * @return void
     */
    public function setHeader()
    {
        if (!$this->hasHeader()) {
            $this->header = new SoapHeader($this->endpoint, $this->auth->getName(), $this->auth->getData());

            $this->client->__setSoapHeaders($this->header);
        }
    }

    /**
     * Get all the datastores for the current organisation
     *
     * @param boolean $forceGroup
     * @return array
     */
    public function getStores($forceGroup = true)
    {
        $this->setHeader();

        return $this->client->getStores($forceGroup);
    }

    /**
     * Get a single datastore by it's id
     *
     * @param boolean $forceGroup
     * @return array
     */
    public function getStore($id)
    {
        $this->setHeader();

        return $this->client->getStore($id);
    }

    /**
     * Get a single datastore by it's name
     *
     * @param string $name
     * @return array
     */
    public function getStoreByName($name)
    {
        $this->setHeader();

        return $this->client->getStoreByName($name);
    }

    /**
     * Get all the documents for the current datastore
     *
     * @param int $store_id
     * @param array $filters
     * @return array
     */
    public function getDocuments($store_id = null, $filters = array())
    {
        $this->setHeader();

        return $this->client->getDocuments($store_id, $filters);
    }

    /**
     * Get a single document by it's id
     *
     * @param int $id
     * @return array
     */
    public function getDocument($id)
    {
        $this->setHeader();

        return $this->client->getDocument($id);
    }

    /**
     * Get the last edited document
     *
     * @return array
     */
    public function getLastEditedDocument()
    {
        $this->setHeader();

        return $this->client->getLastEditedDocument();
    }

    /**
     * Get edited documents between two unix timestamps
     *
     * @param string $start
     * @param string $end
     * @return array
     */
    public function getEditedDocuments($start, $end)
    {
        $this->setHeader();

        return $this->client->getEditedDocuments($start, $end);
    }

    /**
     * Get the documents for a specific datastore
     *
     * @param integer
     * @return array
     */
    public function getDocumentsByDataStore($id)
    {
        $this->setHeader();

        return $this->client->getDocumentsByDataStore($id);
    }

    /**
     * Get the documents for a specific category
     *
     * @param int $category_id
     * @param int $store_id
     * @return array
     */
    public function getDocumentsForCategory($category_id, $store_id = null)
    {
        $this->setHeader();

        return $this->client->getDocumentsForCategory($category_id, $store_id);
    }

    /**
     * Gets documents by grouped category filter.
     *
     * @param $filter
     * @param $paging
     * @param null $store_id
     * @param string $query_type
     * @return mixed
     */
    public function filterDocumentsByCategory($filter, $paging, $store_id = null, $query_type = 'and')
    {
        $this->setHeader();

        return $this->client->filterDocumentsByCategory($filter, $paging, $store_id, $query_type);
    }

    /**
     * Get a specific category by it's id
     *
     * @param int $category_id
     * @param int $store_id
     * @return array
     */
    public function getCategory($category_id, $store_id = null)
    {
        $this->setHeader();

        return $this->client->getCategory($category_id, $store_id);
    }

    /**
     * Get the categories for a specific datastore
     *
     * @param int $store_id
     * @return array
     */
    public function getCategoriesForStore($store_id)
    {
        $this->setHeader();

        return $this->client->getCategoriesForStore($store_id);
    }

    /**
     * Get the XML version of a document
     *
     * @param int $id
     * @return string
     */
    public function getDocumentXml($id)
    {
        $this->setHeader();

        return $this->client->getDocumentXml($id);
    }

    /**
     * Get the PDF version of a document
     *
     * @param int $id
     * @param int $datastore_id
     * @return string
     */
    public function getDocumentPdf($id, $datastore_id = null)
    {
        $this->setHeader();

        return $this->client->getDocumentPdf($id, $datastore_id);
    }

    /**
     * Get the HTML version of a document
     *
     * @param int $id
     * @param int $datastore_id
     * @return string
     */
    public function getDocumentHtml($id, $datastore_id = null)
    {
        $this->setHeader();

        return $this->client->getDocumentHtml($id, $datastore_id);
    }

    /**
     * Search the API for a particular term
     *
     * @param string $term
     * @param int $start
     * @param int $limit
     * @param string $type
     * @return array
     */
    public function documentSearch($term, $start = 0, $limit = 10, $type = false)
    {
        $this->setHeader();

        return $this->client->documentSearch($term, $start, $limit, $type);
    }

}
