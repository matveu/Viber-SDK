<?php

namespace matviichuk\ViberSdk\Interfaces;

/**
 * Interface ApiInterface
 * @package matviichuk\ViberSdk\Interfaces
 */
interface ApiInterface
{
    /**
     * @param $parameter ParameterInterface
     * @return array
     */
    public function sendMessage(ParameterInterface $parameter);

    /**
     * @param string $messageId
     * @return array
     */
    public function getShortDrByMessageId($messageId);

    /**
     * @param string $extraId
     * @return array
     */
    public function getShortDrByExtraId($extraId);

    /**
     * @param string $messageId
     * @return array
     */
    public function getFullDrByMessageId($messageId);

    /**
     * @param string $extraId
     * @return array
     */
    public function getFullDrByExtraId($extraId);
}