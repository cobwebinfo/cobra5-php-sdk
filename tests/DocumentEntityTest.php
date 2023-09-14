<?php

use CobwebInfo\Cobra5Sdk\Entity\Document;

class DocumentEntityTest extends \PHPUnit\Framework\TestCase
{
    public function testIsPublishedReturnsBoolean()
    {
        $document = new Document(['published' => true]);
        $this->assertTrue($document->isPublished());
    }
}
