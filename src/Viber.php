<?php

namespace matviichuk\ViberSdk;

use matviichuk\ViberSdk\Exceptions\InvalidConfigException;
use matviichuk\ViberSdk\Interfaces\ViberInterface;

/**
 * Class Viber
 *
 * @package matviichuk\ViberSdk
 */

class Viber implements ViberInterface
{
    const   REQUIRE_OPTIONS = [
        'ttl',
        'ios_expirity_text',
        'text'
    ];

    const   TTL_MIN_VALUE   = 15;
    const   TTL_MAX_VALUE   = 86400;

    private $text;
    private $img;
    private $ttl;
    private $caption;
    private $action;
    private $ios_expirity_text;

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setImgUrl($imgUrl)
    {
        $this->img = $imgUrl;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setIosExpirityText($ios_expirity_text)
    {
        $this->ios_expirity_text = $ios_expirity_text;
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
        if (!isset($this->ios_expirity_text) || !isset($this->ttl) || !isset($this->text)) {
            throw new InvalidConfigException('Set all require parameters');
        }

        $params = [
            "ios_expirity_text" => $this->ios_expirity_text,
            "ttl"               => $this->ttl,
            "text"              => $this->text
        ];

        if (isset($this->img)) {
            $params['img'] = $this->img;
        }

        if (isset($this->caption)) {
            $params['caption'] = $this->caption;
        }

        if (isset($this->action)) {
            $params['action'] = $this->action;
        }

        return $params;
    }
}