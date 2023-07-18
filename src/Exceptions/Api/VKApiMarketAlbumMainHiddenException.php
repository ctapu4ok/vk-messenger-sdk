<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketAlbumMainHiddenException extends VKApiException
{
    /**
     * VKApiMarketAlbumMainHiddenException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1446, 'Main album can not be hidden', $error);
    }
}

