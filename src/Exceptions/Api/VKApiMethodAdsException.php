<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMethodAdsException extends VKApiException
{
    /**
     * VKApiMethodAdsException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(21, 'Permission to perform this action is allowed only for standalone and OpenAPI applications', $error);
    }
}

