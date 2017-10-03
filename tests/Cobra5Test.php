<?php

use Mockery as m;
use CobwebInfo\Cobra5Sdk\Cobra5;

class Cobra5Test extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->client = m::mock('CobwebInfo\Cobra5Sdk\Client\Cobra5SoapClient');
        $this->cobra5 = new Cobra5($this->client);
    }

    public function tearDown()
    {
        m::close();
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testCobra5RequiresCobra5InterfaceDependency()
    {
        $cobra5 = new Cobra5(new stdClass);
    }

    public function testGetStoresMethodReturnsCollection()
    {
        $this->client->shouldReceive('getStores')->andReturn([]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $this->cobra5->getStores());
    }

    public function testGetStoreMethodReturnsDatastoreEntity()
    {
        $this->client->shouldReceive('getStore')->andReturn(['categories' => []]);
        $this->assertInstanceOf('CobwebInfo\Cobra5Sdk\Entity\Datastore', $this->cobra5->getStore(1));
    }

    public function testGetStoreByNameMethodReturnsDatastoreEntity()
    {
        $this->client->shouldReceive('getStoreByName')->andReturn([]);
        $this->assertInstanceOf('CobwebInfo\Cobra5Sdk\Entity\Datastore', $this->cobra5->getStoreByName('name'));
    }

    public function testGetDocumentsMethodReturnsCollection()
    {
        $this->client->shouldReceive('getDocuments')->andReturn([]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $this->cobra5->getDocuments());
    }

    public function testGetDocumentReturnsDocumentEntity()
    {
        $this->client->shouldReceive('getDocument')->andReturn([]);
        $this->assertInstanceOf('CobwebInfo\Cobra5Sdk\Entity\Document', $this->cobra5->getDocument(1));
    }

    public function testGetLastEditedDocumentReturnsDocumentEntity()
    {
        $this->client->shouldReceive('getLastEditedDocument')->andReturn([]);
        $this->assertInstanceOf('CobwebInfo\Cobra5Sdk\Entity\Document', $this->cobra5->getLastEditedDocument());
    }

    public function testGetEditedDocumentsReturnsCollection()
    {
        $this->client->shouldReceive('getEditedDocuments')->andReturn([]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $this->cobra5->getEditedDocuments('', ''));
    }

    public function testGetDocumentsByDataStoreReturnsCollection()
    {
        $this->client->shouldReceive('getDocumentsByDataStore')->andReturn([]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $this->cobra5->getDocumentsByDataStore(1));
    }

    public function testGetDocumentsForCategoryReturnsCollection()
    {
        $this->client->shouldReceive('getDocumentsForCategory')->andReturn([]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $this->cobra5->getDocumentsForCategory(1));
    }

    public function testFilterDocumentsByCategoryReturnsCollectionAndPaging()
    {
        $this->client->shouldReceive('filterDocumentsByCategory')->andReturn(['results' => [], 'paging' => []]);
        $resp = $this->cobra5->filterDocumentsByCategory(
            new \CobwebInfo\Cobra5Sdk\Parameters\GroupedFilterParam(),
            new \CobwebInfo\Cobra5Sdk\Parameters\PagingParam()
        );
        $this->assertInstanceOf('Illuminate\Support\Collection', $resp['results']);
        $this->assertInternalType('array', $resp['paging']);
    }

    public function testGetCategoryReturnsCategoryEntity()
    {
        $this->client->shouldReceive('getCategory')->andReturn([0 => []]);
        $this->assertInstanceOf('CobwebInfo\Cobra5Sdk\Entity\Category', $this->cobra5->getCategory(1));
    }

    public function testGetCategoriesForStoreReturnsCollection()
    {
        $this->client->shouldReceive('getCategoriesForStore')->andReturn([]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $this->cobra5->getCategoriesForStore(1));
    }

    public function testGetDocumentXmlReturnsString()
    {
        $this->client->shouldReceive('getDocumentXml')->andReturn('');
        $this->assertEquals('', $this->cobra5->getDocumentXml(1));
    }

    public function testGetDocumentPdfReturnsString()
    {
        $this->client->shouldReceive('getDocumentPdf')->andReturn('');
        $this->assertEquals('', $this->cobra5->getDocumentPdf(1));
    }

    public function testGetDocumentHtmlReturnsString()
    {
        $this->client->shouldReceive('getDocumentHtml')->andReturn('');
        $this->assertEquals('', $this->cobra5->getDocumentHtml(1));
    }

    public function testDocumentSearchReturnsCollection()
    {
        $this->client->shouldReceive('documentSearch')->andReturn(['hits' => []]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $this->cobra5->documentSearch('term', 0, 10));
    }

    public function testGetPagedDocumentsReturnsCollectionAndPaging()
    {
        $this->client->shouldReceive('getPagedDocuments')->andReturn(['results' => [], 'paging' => []]);
        $resp = $this->cobra5->getPagedDocuments(1,1, new \CobwebInfo\Cobra5Sdk\Parameters\PagingParam());
        $this->assertInstanceOf('Illuminate\Support\Collection', $resp['results']);
        $this->assertInternalType('array', $resp['paging']);
    }
    public function testGetPagedDocumentsReturnsDocumentEntity()
    {
        $this->client->shouldReceive('getPagedDocuments')->andReturn([
            'results' => [
                ['id' => 1]
            ],
            'paging' => []
        ]);

        $response = $this->cobra5->getPagedDocuments();

        $this->assertInstanceOf('CobwebInfo\Cobra5Sdk\Entity\Document', $response['results'][0]);
    }

    public function testGetFileReturnsExpected()
    {
        $this->client->shouldReceive('getFile')->andReturn([]);
        $this->assertInternalType('array', $this->cobra5->getFile(1));
    }
    public function testGetFilesReturnsCollection()
    {
        $this->client->shouldReceive('getFiles')->andReturn([]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $this->cobra5->getFiles());
    }
}
