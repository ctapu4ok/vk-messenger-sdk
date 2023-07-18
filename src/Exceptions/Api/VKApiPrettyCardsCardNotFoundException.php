<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiPrettyCardsCardNotFoundException extends VKApiException
{
    /**
     * VKApiPrettyCardsCardNotFoundException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1900, 'Card not found', $error);
    }
}

