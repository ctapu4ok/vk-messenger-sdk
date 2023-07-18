<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAppsSubscriptionInvalidStatusException extends VKApiException
{
    /**
     * VKApiAppsSubscriptionInvalidStatusException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1257, 'Subscription is in invalid status', $error);
    }
}

