<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesCantPinExpiringMessageException extends VKApiException
{
    /**
     * VKApiMessagesCantPinExpiringMessageException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(970, 'Cannot pin an expiring message', $error);
    }
}

