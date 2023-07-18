<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketPhotosCropSizeTooLowException extends VKApiException
{
    /**
     * VKApiMarketPhotosCropSizeTooLowException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1435, 'Crop size is less than the minimum', $error);
    }
}

