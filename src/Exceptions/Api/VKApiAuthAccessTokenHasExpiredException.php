<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAuthAccessTokenHasExpiredException extends VKApiException
{
    /**
     * VKApiAuthAccessTokenHasExpiredException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1117, 'Access token has expired', $error);
    }
}

