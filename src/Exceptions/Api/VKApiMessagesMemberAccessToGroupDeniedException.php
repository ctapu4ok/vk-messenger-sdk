<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesMemberAccessToGroupDeniedException extends VKApiException
{
    /**
     * VKApiMessagesMemberAccessToGroupDeniedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(947, 'Can\'t add user to chat, because user has no access to group', $error);
    }
}

