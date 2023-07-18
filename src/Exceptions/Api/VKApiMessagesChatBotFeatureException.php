<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesChatBotFeatureException extends VKApiException
{
    /**
     * VKApiMessagesChatBotFeatureException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(912, 'This is a chat bot feature, change this status in settings', $error);
    }
}

