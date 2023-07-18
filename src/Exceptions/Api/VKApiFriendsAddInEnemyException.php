<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiFriendsAddInEnemyException extends VKApiException
{
    /**
     * VKApiFriendsAddInEnemyException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(175, 'Cannot add this user to friends as they have put you on their blacklist', $error);
    }
}

