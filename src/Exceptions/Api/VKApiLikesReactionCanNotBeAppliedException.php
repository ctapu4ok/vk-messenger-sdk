<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiLikesReactionCanNotBeAppliedException extends VKApiException
{
    /**
     * VKApiLikesReactionCanNotBeAppliedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(232, 'Reaction can not be applied to the object', $error);
    }
}

