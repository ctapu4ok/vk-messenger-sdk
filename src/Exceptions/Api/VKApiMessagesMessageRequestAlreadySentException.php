<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesMessageRequestAlreadySentException extends VKApiException
{
    /**
     * VKApiMessagesMessageRequestAlreadySentException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(939, 'Message request already sent', $error);
    }
}

