<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiPrettyCardsCardIsConnectedToPostException extends VKApiException
{
    /**
     * VKApiPrettyCardsCardIsConnectedToPostException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1902, 'Card is connected to post', $error);
    }
}

