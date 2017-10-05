<?php

namespace CobwebInfo\Cobra5Sdk\Parameters;

/**
 * Class PagingParam
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
        $this->page = (int) $page;
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
        $this->take = (int) $take;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            $this->getParamAsObject('page', $this->getPage()),
            $this->getParamAsObject('take', $this->getTake()),
        ];
    }

    /**
     * @param $name
     * @param $value
     * @return \StdClass
     */
    protected function getParamAsObject($name, $value) {
        $payload = new \StdClass();

        $payload->key = $name;
        $payload->value = $value;

        return $payload;
    }
}