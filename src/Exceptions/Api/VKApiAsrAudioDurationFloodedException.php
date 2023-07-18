<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAsrAudioDurationFloodedException extends VKApiException
{
    /**
     * VKApiAsrAudioDurationFloodedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(7701, 'Total audio duration limit reached', $error);
    }
}

