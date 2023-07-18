<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAdsLookalikeRequestMaxCountPerDayReachedException extends VKApiException
{
    /**
     * VKApiAdsLookalikeRequestMaxCountPerDayReachedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(631, 'Max count of lookalike requests per day reached', $error);
    }
}

