<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAuthAnonymousTokenIpMismatchException extends VKApiException
{
    /**
     * VKApiAuthAnonymousTokenIpMismatchException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1118, 'Anonymous token ip mismatch', $error);
    }
}

