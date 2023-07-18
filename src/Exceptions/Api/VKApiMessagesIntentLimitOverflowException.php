<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesIntentLimitOverflowException extends VKApiException
{
    /**
     * VKApiMessagesIntentLimitOverflowException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(944, 'Limits overflow for this intent', $error);
    }
}

