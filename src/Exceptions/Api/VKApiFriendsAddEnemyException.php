<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiFriendsAddEnemyException extends VKApiException
{
    /**
     * VKApiFriendsAddEnemyException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(176, 'Cannot add this user to friends as you put him on blacklist', $error);
    }
}

