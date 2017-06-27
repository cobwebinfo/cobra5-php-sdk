<?php

namespace CobwebInfo\Cobra5Sdk\Parameters;

/**
 * Class GroupedFilterParam
 *
 * @package CobwebInfo\Cobra5Sdk\Parameters
 */
class GroupedFilterParam
{
    /**
     * @var array
     */
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