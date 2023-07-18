<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesPrivacyException extends VKApiException
{
    /**
     * VKApiMessagesPrivacyException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(902, 'Can\'t send messages to this user due to their privacy settings', $error);
    }
}

