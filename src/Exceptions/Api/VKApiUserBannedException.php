<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiUserBannedException extends VKApiException
{
    /**
     * VKApiUserBannedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(37, 'User was banned', $error);
    }
}

