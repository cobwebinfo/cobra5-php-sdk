<?php

namespace CobwebInfo\Cobra5Sdk\Parameters;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 27/06/17
 * Time: 11:11
 */
class GroupedFilterParam
{
    protected $filter = [];

    /**
     * Given a 1 dimensional array of Ids,
     * transforms to format supported by the API.
     *
     * @param array $ids
     * @param string $mode
     */
    public function addGroup($ids = [], $mode = 'any')
    {
        $this->filter[] = [
            'mode' => $mode,
            'ids' => $ids
        ];
    }

    /**
     * Returns the filter as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->filter;
    }
}