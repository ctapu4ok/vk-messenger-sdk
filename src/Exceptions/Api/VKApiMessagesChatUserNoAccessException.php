<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesChatUserNoAccessException extends VKApiException
{
    /**
     * VKApiMessagesChatUserNoAccessException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(917, 'You don\'t have access to this chat', $error);
    }
}

