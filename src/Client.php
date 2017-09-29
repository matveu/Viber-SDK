<?php

namespace matviichuk\ViberSdk;

use matviichuk\ViberSdk\Exceptions\InvalidConfigException;
use matviichuk\ViberSdk\Interfaces\ClientInterface;

/**
 * Class Client
 *
 * @package matviichuk\ViberSdk
 */
class Client implements ClientInterface
{
    private $login;
    private $password;

    public function __construct($params)
    {
        if (!isset($params['login']) || !isset($params['password'])) {
            throw new InvalidConfigException('Login and password must be set');
        }

        $this->login    = $params['login'];
        $this->password = $params['password'];
    }

    /**
     * @param $method
     * @param $url
     * @param $params
     *
     * @return mixed
     */
    public function request($method, $url, $params = [])
    {
        $ch = curl_init();

        if ($method === "POST") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER,
            ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERPWD,
            sprintf("%s:%s", $this->login, $this->password));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $data = json_decode(curl_exec($ch), true);

        curl_close($ch);

        return $data;
    }
}