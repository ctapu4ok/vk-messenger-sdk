<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesEditKindDisallowedException extends VKApiException
{
    /**
     * VKApiMessagesEditKindDisallowedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(920, 'Can\'t edit this kind of message', $error);
    }
}

