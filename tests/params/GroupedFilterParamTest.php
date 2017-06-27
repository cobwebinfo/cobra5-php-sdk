<?php

use CobwebInfo\Cobra5Sdk\Parameters\GroupedFilterParam;

class GroupedFilterParamTest extends PHPUnit_Framework_TestCase {

    public function testCanAddGroup()
    {
        $param = new GroupedFilterParam();

        $param->addGroup([1,2,3]);

        $expected = [
            [
                'ids' => [1,2,3],
                'mode' => 'any'
            ]
        ];

        $this->assertEquals($expected, $param->toArray());
    }

    public function testCanChangeGroupMode()
    {
        $param = new GroupedFilterParam();

        $param->addGroup([1,2,3], 'all');

        $expected = [
            [
                'ids' => [1,2,3],
                'mode' => 'all'
            ]
        ];

        $this->assertEquals($expected, $param->toArray());
    }
}