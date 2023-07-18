<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAccessGroupsException extends VKApiException
{
    /**
     * VKApiAccessGroupsException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(260, 'Access to the groups list is denied due to the user\'s privacy settings', $error);
    }
}

