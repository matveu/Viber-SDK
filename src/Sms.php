<?php

namespace matviichuk\ViberSdk;

use matviichuk\ViberSdk\Exceptions\InvalidConfigException;
use matviichuk\ViberSdk\Interfaces\SmsInterface;

/**
 * Class Sms
 *
 * @package matviichuk\ViberSdk
 */

class Sms implements SmsInterface
{
    const   REQUIRE_OPTIONS = [
            'text',
            'alpha_name',
            'ttl'
        ];

    const   TTL_MIN_VALUE   = 15;
    const   TTL_MAX_VALUE   = 86400;

    private $text;
    private $alpha_name;
    private $ttl;

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setAlphaName($alphaName)
    {
        $this->alpha_name = $alphaName;
    }

    public function setTtl($ttl)
    {
        if ($ttl < self::TTL_MIN_VALUE || $ttl > self::TTL_MAX_VALUE) {
            throw new InvalidConfigException('Set valid ttl value');
        }

        $this->ttl = $ttl;
    }

    public function getModifyParameters()
    {
        if (!isset($this->text) || !isset($this->alpha_name) || !isset($this->ttl)) {
            throw new InvalidConfigException('Set all require parameters');
        }

        $params = [
            "text"       => $this->text,
            "alpha_name" => $this->alpha_name,
            "ttl"        => $this->ttl
        ];

        return $params;
    }
}