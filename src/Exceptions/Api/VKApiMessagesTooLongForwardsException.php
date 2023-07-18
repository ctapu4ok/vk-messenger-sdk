<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesTooLongForwardsException extends VKApiException
{
    /**
     * VKApiMessagesTooLongForwardsException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(913, 'Too many forwarded messages', $error);
    }
}

