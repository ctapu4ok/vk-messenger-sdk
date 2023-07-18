<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiPollsAccessWithoutVoteException extends VKApiException
{
    /**
     * VKApiPollsAccessWithoutVoteException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(253, 'Access denied, please vote first', $error);
    }
}

