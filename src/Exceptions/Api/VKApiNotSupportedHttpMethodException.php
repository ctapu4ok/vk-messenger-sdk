<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiNotSupportedHttpMethodException extends VKApiException
{
    /**
     * VKApiNotSupportedHttpMethodException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(9999, 'Not supported http method', $error);
    }
}

