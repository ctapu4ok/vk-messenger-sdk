<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAuthAnonymousTokenHasExpiredException extends VKApiException
{
    /**
     * VKApiAuthAnonymousTokenHasExpiredException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1114, 'Anonymous token has expired', $error);
    }
}

