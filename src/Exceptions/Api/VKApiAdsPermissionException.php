<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAdsPermissionException extends VKApiException
{
    /**
     * VKApiAdsPermissionException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(600, 'Permission denied. You have no access to operations specified with given object(s)', $error);
    }
}

