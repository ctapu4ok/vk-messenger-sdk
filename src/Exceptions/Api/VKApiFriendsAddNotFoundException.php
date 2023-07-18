<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiFriendsAddNotFoundException extends VKApiException
{
    /**
     * VKApiFriendsAddNotFoundException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(177, 'Cannot add this user to friends as user not found', $error);
    }
}

