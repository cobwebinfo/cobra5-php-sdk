<?php

use CobwebInfo\Cobra5Sdk\Parameters\PagingParam;

class PagingParamTest extends PHPUnit_Framework_TestCase {

    public function testDefaults()
    {
        $param = new PagingParam();

        $expected = [
            'page' => 1,
            'take' => 25
        ];

        $this->assertEquals($expected, $param->toArray());
    }

    public function testCanSetPage()
    {
        $param = new PagingParam();

        $param->setPage(2);

        $expected = [
            'page' => 2,
            'take' => 25
        ];

        $this->assertEquals($expected, $param->toArray());
    }

    public function testCanSetTake()
    {
        $param = new PagingParam();

        $param->setTake(50);

        $expected = [
            'page' => 1,
            'take' => 50
        ];

        $this->assertEquals($expected, $param->toArray());
    }

    public function testCastsAsInt()
    {
        $param = new PagingParam();

        $param->setTake('1.1');
        $param->setPage('3.3');

        $expected = [
            'page' => 3,
            'take' => 1
        ];

        $this->assertEquals($expected, $param->toArray());
    }
}
