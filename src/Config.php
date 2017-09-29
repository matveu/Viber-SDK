<?php

namespace matviichuk\ViberSdk;

use matviichuk\ViberSdk\Interfaces\ConfigInterface;

class Config implements ConfigInterface
{
    const   BASE_URL                    = 'https://api-v2.hyber.im/790',
            FULL_DR_BY_MESSAGE_ID_URL   = 'https://dr.hyber.im/api/dr/{message_id}/advanced',
            FULL_DR_BY_EXTRA_ID_URL     = 'https://dr.hyber.im/api/dr/external/{extra_id}/advanced',
            SHORT_DR_BY_MESSAGE_ID_URL  = 'https://dr.hyber.im/api/dr/{message_id}/simple',
            SHORT_DR_BY_EXTRA_ID_URL    = 'https://dr.hyber.im/api/dr/external/{extra_id}/simple';

    private $messageId;
    private $extraId;

    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    }

    public function setExtraId($extraId)
    {
        $this->extraId = $extraId;
    }

    /**
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return string
     */
    public function getExtraId()
    {
        return $this->extraId;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return self::BASE_URL;
    }

    public function getFullDrByMessageIdUrl()
    {
        return strtr(self::FULL_DR_BY_MESSAGE_ID_URL, [
            '{message_id}' => $this->messageId,
        ]);
    }

    public function getFullDrByExtraIdUrl()
    {
        return strtr(self::FULL_DR_BY_EXTRA_ID_URL, [
            '{extra_id}' => $this->extraId,
        ]);
    }

    public function getShortDrByMessageIdUrl()
    {
        return strtr(self::SHORT_DR_BY_MESSAGE_ID_URL, [
            '{message_id}' => $this->messageId,
        ]);
    }

    public function getShortDrByExtraIdUrl()
    {
        return strtr(self::SHORT_DR_BY_EXTRA_ID_URL, [
            '{extra_id}' => $this->extraId,
        ]);
    }
}