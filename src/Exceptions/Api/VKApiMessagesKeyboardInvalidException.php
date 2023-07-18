<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesKeyboardInvalidException extends VKApiException
{
    /**
     * VKApiMessagesKeyboardInvalidException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(911, 'Keyboard format is invalid', $error);
    }
}

