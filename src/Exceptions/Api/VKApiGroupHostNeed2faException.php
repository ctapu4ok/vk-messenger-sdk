<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiGroupHostNeed2faException extends VKApiException
{
    /**
     * VKApiGroupHostNeed2faException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(704, 'User needs to enable 2FA for this action', $error);
    }
}

