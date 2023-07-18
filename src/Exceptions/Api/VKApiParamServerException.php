<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiParamServerException extends VKApiException
{
    /**
     * VKApiParamServerException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(118, 'Invalid server', $error);
    }
}

