<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAdsLookalikeRequestAudienceTooLargeException extends VKApiException
{
    /**
     * VKApiAdsLookalikeRequestAudienceTooLargeException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(633, 'Given audience is too large', $error);
    }
}

