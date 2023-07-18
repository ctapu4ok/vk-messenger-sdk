<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesCantChangeInviteLinkException extends VKApiException
{
    /**
     * VKApiMessagesCantChangeInviteLinkException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(931, 'You can\'t change invite link for this chat', $error);
    }
}

