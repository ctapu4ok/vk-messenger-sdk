<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiEnabledInTestException extends VKApiException
{
    /**
     * VKApiEnabledInTestException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(11, 'In test mode application should be disabled or user should be authorized', $error);
    }
}

