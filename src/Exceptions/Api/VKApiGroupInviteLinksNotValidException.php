<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiGroupInviteLinksNotValidException extends VKApiException
{
    /**
     * VKApiGroupInviteLinksNotValidException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(714, 'Invite link is invalid - expired, deleted or not exists', $error);
    }
}

