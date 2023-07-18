<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketPhotosCropOverflowException extends VKApiException
{
    /**
     * VKApiMarketPhotosCropOverflowException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1434, 'Crop bottom right corner is outside of the image', $error);
    }
}

