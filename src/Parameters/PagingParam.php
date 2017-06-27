<?php

namespace CobwebInfo\Cobra5Sdk\Parameters;

/**
 * Class PagingParam
 *
 * @package CobwebInfo\Cobra5Sdk\Parameters
 */
class PagingParam
{
    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var int
     */
    protected $take = 25;

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param string $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getTake()
    {
        return $this->take;
    }

    /**
     * @param int $take
     */
    public function setTake($take)
    {
        $this->take = $take;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'page' => $this->getPage(),
            'take' => $this->getTake()
        ];
    }
}