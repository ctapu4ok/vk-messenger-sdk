<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesMessageCannotBeForwardedException extends VKApiException
{
    /**
     * VKApiMessagesMessageCannotBeForwardedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(969, 'Message cannot be forwarded', $error);
    }
}

