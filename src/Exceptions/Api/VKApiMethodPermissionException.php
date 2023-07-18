<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMethodPermissionException extends VKApiException
{
    /**
     * VKApiMethodPermissionException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(20, 'Permission to perform this action is denied for non-standalone applications', $error);
    }
}

