<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiFriendsAddYourselfException extends VKApiException
{
    /**
     * VKApiFriendsAddYourselfException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(174, 'Cannot add user himself as friend', $error);
    }
}

