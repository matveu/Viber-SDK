<?php

namespace matviichuk\ViberSdk\Interfaces;

/**
 * Interface ClientInterface
 * @package matviichuk\ViberSdk\Interfaces
 */
interface ClientInterface
{
    /**
     * @param $method
     * @param $url
     * @param $params
     * @return mixed
     */
    public function request($method, $url, $params);
}