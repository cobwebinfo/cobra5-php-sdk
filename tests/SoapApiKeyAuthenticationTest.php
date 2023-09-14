<?php

use CobwebInfo\Cobra5Sdk\Authentication\SoapApiKeyAuthentication;

class SoapApiKeyAuthenticationTest extends \PHPUnit\Framework\TestCase
{

    public function testGettingValuesFromObject()
    {
        $entity = new SoapApiKeyAuthentication('Auth', 'this_is_my_key');

        $this->assertEquals('Auth', $entity->getName());
        $this->assertEquals(['api_key' => 'this_is_my_key'], $entity->getData());
    }

}
