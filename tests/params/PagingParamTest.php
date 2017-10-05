<?php

use CobwebInfo\Cobra5Sdk\Parameters\PagingParam;

class PagingParamTest extends PHPUnit_Framework_TestCase {

    public function testDefaults()
    {
        $param = new PagingParam();

        $expected = [
            $this->getParamAsObject('page', 1),
            $this->getParamAsObject('take', 25)
        ];

        $this->assertEquals($expected, $param->toArray());
    }

    public function testCanSetPage()
    {
        $param = new PagingParam();

        $param->setPage(2);

        $expected = [
            $this->getParamAsObject('page', 2),
            $this->getParamAsObject('take', 25)
        ];

        $this->assertEquals($expected, $param->toArray());
    }

    public function testCanSetTake()
    {
        $param = new PagingParam();

        $param->setTake(50);

        $expected = [
            $this->getParamAsObject('page', 1),
            $this->getParamAsObject('take', 50)
        ];
        $this->assertEquals($expected, $param->toArray());
    }

    public function testCastsAsInt()
    {
        $param = new PagingParam();

        $param->setTake('1.1');
        $param->setPage('3.3');

        $expected = [
            $this->getParamAsObject('page', 3),
            $this->getParamAsObject('take', 1)
        ];

        $this->assertEquals($expected, $param->toArray());
    }

    protected function getParamAsObject($name, $value) {
        $payload = new \StdClass();

        $payload->key = $name;
        $payload->value = $value;

        return $payload;
    }
}