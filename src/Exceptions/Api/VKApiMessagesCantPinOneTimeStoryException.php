<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesCantPinOneTimeStoryException extends VKApiException
{
    /**
     * VKApiMessagesCantPinOneTimeStoryException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(942, 'Cannot pin one-time story', $error);
    }
}

