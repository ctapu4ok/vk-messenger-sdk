<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesEditExpiredException extends VKApiException
{
    /**
     * VKApiMessagesEditExpiredException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(909, 'Can\'t edit this message, because it\'s too old', $error);
    }
}

