<?php namespace CobwebInfo\Cobra5Sdk;

use CobwebInfo\Cobra5Sdk\Parameters\GroupedFilterParam;
use CobwebInfo\Cobra5Sdk\Parameters\PagingParam;
use Illuminate\Support\Collection;
use CobwebInfo\Cobra5Sdk\Entity\Document;
use CobwebInfo\Cobra5Sdk\Entity\Category;
use CobwebInfo\Cobra5Sdk\Entity\Datastore;

class Cobra5 implements Cobra5Interface {

    /**
     * The client instance
     *
     * @var CobwebInfo\Cobra5Sdk\Cobra5Interface
     */
    protected $client;

    /**
     * Create a new instance of the Cobra5 PHP SDK
     *
     * @param CobwebInfo\Cobra5Sdk\Cobra5Interface
     * @return void
     */
    public function __construct(Cobra5Interface $client)
    {
        $this->client = $client;
    }

    /**
     * Get all the datastores for the current organisation
     *
     * @param boolean $forceGroup
     * @return Illuminate\Support\Collection
     */
    public function getStores($forceGroup = true)
    {
        $response = $this->client->getStores($forceGroup);

        $collection = new Collection;

        foreach($response as $item)
        {
            $collection[] = new Datastore($item);
        }

        return $collection;
    }

    /**
     * Get a single datastore by it's id
     *
     * @param int $id
     * @return CobwebInfo\Cobra5Sdk\Entity\Datastore
     */
    public function getStore($id)
    {
        $response = $this->client->getStore($id);

        $categories = new Collection;

        foreach($response['categories'] as $category)
        {
            $categories[] = new Category($category);
        }

        $response['categories'] = $categories;

        return new Datastore($response);
    }

    /**
     * Get a single datastore by it's name
     *
     * @param string $name
     * @return CobwebInfo\Cobra5Sdk\Entity\Datastore
     */
    public function getStoreByName($name)
    {
        $response = $this->client->getStoreByName($name);

        return new Datastore($response);
    }

    /**
     * Get all the documents for the current datastore
     *
     * @param int $store_id
     * @param array $filters
     * @return Illuminate\Support\Collection
     */
    public function getDocuments($store_id = null, $filters = array())
    {
        $response = $this->client->getDocuments($store_id, $filters);

        $collection = new Collection;

        foreach($response as $item)
        {
            $collection[] = new Document($item);
        }

        return $collection;
    }

    /**
     * Get a single document by it's id
     *
     * @param int $id
     * @return CobwebInfo\Cobra5Sdk\Entity\Document
     */
    public function getDocument($id)
    {
        $response = $this->client->getDocument($id);

        return new Document($response);
    }

    /**
     * Get the last edited document
     *
     * @return CobwebInfo\Cobra5Sdk\Entity\Document
     */
    public function getLastEditedDocument()
    {
        $response = $this->client->getLastEditedDocument();

        return new Document($response);
    }

    /**
     * Get edited documents between two unix timestamps
     *
     * @param string $start
     * @param string $end
     * @return Illuminate\Support\Collection
     */
    public function getEditedDocuments($start, $end)
    {
        $response = $this->client->getEditedDocuments($start, $end);

        $collection = new Collection;

        foreach($response as $item)
        {
            $collection[] = new Document($item);
        }

        return $collection;
    }

    /**
     * Get the documents for a specific datastore
     *
     * @param int $datastore_id
     * @return Illuminate\Support\Collection
     */
    public function getDocumentsByDataStore($datastore_id)
    {
        $response = $this->client->getDocumentsByDataStore($datastore_id);

        $collection = new Collection;

        foreach($response as $item)
        {
            $collection[] = new Document($item);
        }

        return $collection;
    }

    /**
     * Get the documents for a specific category
     *
     * @param int $category_id
     * @param int $store_id
     * @return Illuminate\Support\Collection
     */
    public function getDocumentsForCategory($category_id, $store_id = null)
    {
        $response = $this->client->getDocumentsForCategory($category_id, $store_id);

        $collection = new Collection;

        foreach($response as $item)
        {
            $collection[] = new Document($item);
        }

        return $collection;
    }

    /**
     * Gets the documents via a grouped category filter.
     *
     * @param GroupedFilterParam $filter
     * @param PagingParam $paging
     * @param null $store_id
     * @param string $query_type
     * @return array
     */
    public function filterDocumentsByCategory(
        GroupedFilterParam $filter,
        PagingParam $paging,
        $store_id = null,
        $query_type = 'and'
    ) {
        $response = $this->client->filterDocumentsByCategory(
            $filter->toArray(),
            $paging->toArray(),
            $store_id,
            $query_type
        );
        $collection = new Collection;
        foreach ($response['results'] as $item) {
            $collection[] = $item;
        }
        return [
            'results' => $collection,
            'paging' => $response['paging']
        ];
    }

    /**
     * Get a specific category by it's id
     *
     * @param int $category_id
     * @param int $store_id
     * @return CobwebInfo\Cobra5Sdk\Entity\Category
     */
    public function getCategory($category_id, $store_id = null)
    {
        $response = $this->client->getCategory($category_id, $store_id);

        if(count($response) == 1)
        {
            return new Category($response[0]);
        }

        $collection = new Collection;

        foreach($response as $item)
        {
            if($item['id'] !== (int) $category_id)
            {
                $collection[] = new Category($item);
            }
        }

        return $collection;
    }

    /**
     * Get the categories for a specific datastore
     *
     * @param int $store_id
     * @return Illuminate\Support\Collection
     */
    public function getCategoriesForStore($store_id)
    {
        $response = $this->client->getCategoriesForStore($store_id);

        $collection = new Collection;

        foreach($response as $item)
        {
            $collection[] = new Category($item);
        }

        return $collection;
    }

    /**
     * Get the XML version of a document
     *
     * @param int $id
     * @return string
     */
    public function getDocumentXml($id)
    {
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
        return $this->client->getDocumentHtml($id, $datastore_id);
    }

    /**
     * Search the API for a particular term
     *
     * @param string $term
     * @param int $start
     * @param int $limit
     * @param string $type
     * @return Illuminate\Support\Collection
     */
    public function documentSearch($term, $start = 0, $limit = 10, $type = false)
    {
        $response = $this->client->documentSearch($term, $start, $limit, $type);

        $collection = new Collection($response);

        $collection['hits'] = new Collection;

        foreach($response['hits'] as $key => $item)
        {
            $collection['hits'][] = new Document([
                'id'            => $item['id'],
                'name'          => $item['name_original'],
                'document_type' => $item['document_type'],
                'document_id'   => $item['doc_id']
            ]);
        }

        return $collection;
    }

    /**
     * Gets paginated list of documents
     *
     * @param null $store_id
     * @param null $category_id
     * @param PagingParam $paging
     * @return array
     */
    public function getPagedDocuments($store_id = null, $category_id = null, PagingParam $paging)
    {
        $response = $this->client->getPagedDocuments($store_id, $category_id, $paging->toArray());

        $collection = new Collection;

        foreach ($response['results'] as $item) {
            $collection[] = new Document($item);
        }

        return array(
            'results' => $collection,
            'paging' => $response['paging']
        );
    }

    /**
     * Get a single File by its unique identifier.
     *
     * @param $id
     * @return Document
     */
    public function getFile($id)
    {
        return $this->client->getFile($id);
    }
    /**
     * Get all files from the API.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFiles()
    {
        $response = $this->client->getFiles();
        $collection = new Collection;
        foreach ($response as $item) {
            $collection[] = $item;
        }
        return $collection;
    }
}
