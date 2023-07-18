<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiVotesPermissionException extends VKApiException
{
    /**
     * VKApiVotesPermissionException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(500, 'Permission denied. You must enable votes processing in application settings', $error);
    }
}

