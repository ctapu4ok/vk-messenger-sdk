<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiGroupAppIsNotInstalledInCommunityException extends VKApiException
{
    /**
     * VKApiGroupAppIsNotInstalledInCommunityException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(711, 'Application is not installed in community', $error);
    }
}

