<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketOrdersInvalidStatusException extends VKApiException
{
    /**
     * VKApiMarketOrdersInvalidStatusException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1456, 'Order status is invalid', $error);
    }
}

