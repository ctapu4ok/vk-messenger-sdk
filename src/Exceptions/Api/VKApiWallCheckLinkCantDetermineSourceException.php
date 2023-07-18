<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiWallCheckLinkCantDetermineSourceException extends VKApiException
{
    /**
     * VKApiWallCheckLinkCantDetermineSourceException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(3102, 'Specified link is incorrect (can\'t find source)', $error);
    }
}

