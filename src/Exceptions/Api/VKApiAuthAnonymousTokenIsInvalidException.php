<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAuthAnonymousTokenIsInvalidException extends VKApiException
{
    /**
     * VKApiAuthAnonymousTokenIsInvalidException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1116, 'Anonymous token is invalid', $error);
    }
}

