<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAdsLookalikeRequestExportRetargetingGroupLimitException extends VKApiException
{
    /**
     * VKApiAdsLookalikeRequestExportRetargetingGroupLimitException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(636, 'Max count of retargeting groups reached', $error);
    }
}

