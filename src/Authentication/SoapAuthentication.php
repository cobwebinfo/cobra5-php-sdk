<?php namespace CobwebInfo\Cobra5Sdk\Authentication;

interface SoapAuthentication
{

    /**
     * Get the name of the SoapHeader
     *
     * @return string
     */
    public function getName();

    /**
     * Get the SoapHeader data
     *
     * @return array
     */
    public function getData();

}
