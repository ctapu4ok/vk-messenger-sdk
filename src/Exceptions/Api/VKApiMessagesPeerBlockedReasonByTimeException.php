<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesPeerBlockedReasonByTimeException extends VKApiException
{
    /**
     * VKApiMessagesPeerBlockedReasonByTimeException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(950, 'Can\'t send message, reply timed out', $error);
    }
}

