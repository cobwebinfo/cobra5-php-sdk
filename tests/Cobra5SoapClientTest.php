<?php

use Mockery as m;
use CobwebInfo\Cobra5Sdk\Client\Cobra5SoapClient;

class Cobra5SoapClientTest extends \PHPUnit\Framework\TestCase
{

    public function setUp(): void
    {
        $this->auth = m::mock('CobwebInfo\Cobra5Sdk\Authentication\SoapApiKeyAuthentication');

        $this->soap = $mock = $this->getMockBuilder(SoapClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cobra5 = new Cobra5SoapClient($this->soap, $this->auth);

        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function tearDown(): void
    {
        m::close();

        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function testCobra5SoapClientRequiresSoapClient()
    {
        $this->expectException(TypeError::class);

        $cobra5 = new Cobra5SoapClient('', $this->auth);
    }

    public function testCobra5SoapClientRequiresSoapAuthenticationObject()
    {
        $this->expectException(TypeError::class);

        $cobra5 = new Cobra5SoapClient($this->soap, '');
    }

    public function testSettingAndGettingEndpoint()
    {
        $this->assertInstanceOf('CobwebInfo\Cobra5Sdk\Client\Cobra5SoapClient',
            $this->cobra5->setEndpoint('google.com'));
        $this->assertEquals('google.com', $this->cobra5->getEndpoint());
    }

    public function testSetAndCheckHeader()
    {
        $this->auth->shouldReceive('getName')->andReturn('Auth');
        $this->auth->shouldReceive('getData')->andReturn(['api_key' => 'this_is_my_key']);

        $this->assertFalse($this->cobra5->hasHeader());
        $this->cobra5->setHeader();
        $this->assertTrue($this->cobra5->hasHeader());
    }

}
