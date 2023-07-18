<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiStickersTooManyFavoritesException extends VKApiException
{
    /**
     * VKApiStickersTooManyFavoritesException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(2101, 'Too many favorite stickers', $error);
    }
}

