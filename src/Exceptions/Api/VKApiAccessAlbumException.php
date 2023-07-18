<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAccessAlbumException extends VKApiException
{
    /**
     * VKApiAccessAlbumException constructor.
     *
     * @param VKApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(200, 'Access denied', $error);
    }
}
