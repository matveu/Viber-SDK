<?php

namespace matviichuk\ViberSdk;

use matviichuk\ViberSdk\Exceptions\InvalidConfigException;
use DateTime;
use matviichuk\ViberSdk\Interfaces\ParameterInterface;
use matviichuk\ViberSdk\Interfaces\SmsInterface;
use matviichuk\ViberSdk\Interfaces\ViberInterface;

/**
 * Class Parameter
 *
 * @package matviichuk\ViberSdk
 */

class Parameter implements ParameterInterface
{
    const   REQUIRE_BASE_PARAMS     = [
        'phone_number',
        'is_promotional',
        'channels',
        'channel_options'
    ];

    const   VALID_CHANNELS          = [
        'viber',
        'sms'
    ];

    const   EXTRA_ID_MAX_LENGTH     = 64;
    const   TAG_MAX_LENGTH          = 63;
    const   VALID_DATE_FORMAT       = 'Y-m-d H:i:s';

    private $phone_number;
    private $extra_id;
    private $tag;
    private $callback_url;
    private $start_time;
    private $is_promotional;
    private $channels;
    private $channel_options;

    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = preg_replace('/[\s\+]/', '', $phoneNumber);
    }

    public function setExtraId($extraId)
    {
        if (strlen($extraId) > self::EXTRA_ID_MAX_LENGTH) {
            throw new InvalidConfigException('Set valid extra id');
        }

        $this->extra_id = $extraId;
    }

    public function setTag($tag)
    {
        if (strlen($tag) > self::TAG_MAX_LENGTH) {
            throw new InvalidConfigException('Set valid tag');
        }

        $this->tag = $tag;
    }

    public function setCallbackUrl($callbackUrl)
    {
        $this->callback_url = $callbackUrl;
    }

    public function setStartTime($startTime)
    {
        if (!$this->validateDate($startTime)) {
            throw new InvalidConfigException('Set valid start time');
        }

        $this->start_time = $startTime;
    }

    public function setIsPromotional($isPromotional)
    {
        if (!is_bool($isPromotional)) {
            throw new InvalidConfigException('IsPromotional must be an boolean');
        }

        $this->is_promotional = $isPromotional;
    }

    public function setChannels($channels)
    {
        if (empty($channels) || !empty(array_diff($channels, self::VALID_CHANNELS))) {
            throw new InvalidConfigException('Set valid channels');
        }

        $this->channels = $channels;
    }

    public function setChannelsOptions(SmsInterface $sms = null, ViberInterface $viber = null)
    {
        $channelsOptions = [];

        if (!isset($sms) && !isset($viber)) {
            throw new InvalidConfigException('Set valid channels options');
        }

        if (isset($sms)) {
            $channelsOptions['sms']     = $sms->getModifyParameters();
        }

        if (isset($viber)) {
            $channelsOptions['viber']   = $viber->getModifyParameters();
        }

        $this->channel_options = $channelsOptions;
    }

    public function getModifyParameters()
    {
        if (!isset($this->phone_number) || !isset($this->is_promotional)
            || !isset($this->channels)
            || !isset($this->channel_options)
        ) {
            throw new InvalidConfigException('Set all require parameters');
        }

        $params = [
            "phone_number"    => $this->phone_number,
            "is_promotional"  => $this->is_promotional,
            "channels"        => $this->channels,
            "channel_options" => $this->channel_options
        ];

        if (isset($this->extra_id)) {
            $params['extra_id'] = $this->extra_id;
        }

        if (isset($this->tag)) {
            $params['tag'] = $this->tag;
        }

        if (isset($this->callback_url)) {
            $params['callback_url'] = $this->callback_url;
        }

        if (isset($this->start_time)) {
            $params['start_time'] = $this->start_time;
        }

        return $params;
    }

    private function validateDate($date, $format = self::VALID_DATE_FORMAT)
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) == $date;
    }
}