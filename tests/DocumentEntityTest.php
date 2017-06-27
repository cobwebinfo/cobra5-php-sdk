<?php

use CobwebInfo\Cobra5Sdk\Entity\Document;

class DocumentEntityTest extends PHPUnit_Framework_TestCase
{

    public function testIsPublishedReturnsBoolean()
    {
        $document = new Document(['published' => true]);
        $this->assertTrue($document->isPublished());
    }

}
