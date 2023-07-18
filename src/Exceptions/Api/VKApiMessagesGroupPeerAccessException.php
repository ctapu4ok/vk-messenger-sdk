<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesGroupPeerAccessException extends VKApiException
{
    /**
     * VKApiMessagesGroupPeerAccessException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(932, 'Your community can\'t interact with this peer', $error);
    }
}

