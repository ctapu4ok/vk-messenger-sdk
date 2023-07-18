<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAppsAlreadyUnlockedException extends VKApiException
{
    /**
     * VKApiAppsAlreadyUnlockedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1251, 'This achievement is already unlocked', $error);
    }
}

