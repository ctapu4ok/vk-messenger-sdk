<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketTooManyItemsInAlbumException extends VKApiException
{
    /**
     * VKApiMarketTooManyItemsInAlbumException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1406, 'Too many items in album', $error);
    }
}

