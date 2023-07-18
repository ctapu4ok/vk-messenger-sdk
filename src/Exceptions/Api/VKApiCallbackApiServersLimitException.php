<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiCallbackApiServersLimitException extends VKApiException
{
    /**
     * VKApiCallbackApiServersLimitException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(2000, 'Servers number limit is reached', $error);
    }
}

