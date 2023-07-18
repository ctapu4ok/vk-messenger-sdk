<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketPhotosCropInvalidFormatException extends VKApiException
{
    /**
     * VKApiMarketPhotosCropInvalidFormatException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1433, 'Invalid image crop format', $error);
    }
}

