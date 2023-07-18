<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAdsLookalikeRequestAlreadyInProgressException extends VKApiException
{
    /**
     * VKApiAdsLookalikeRequestAlreadyInProgressException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(630, 'Lookalike request with same source already in progress', $error);
    }
}

