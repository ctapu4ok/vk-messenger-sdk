<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesCantSeeInviteLinkException extends VKApiException
{
    /**
     * VKApiMessagesCantSeeInviteLinkException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(919, 'You can\'t see invite link for this chat', $error);
    }
}

