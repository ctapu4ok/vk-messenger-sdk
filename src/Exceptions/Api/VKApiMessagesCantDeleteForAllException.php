<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesCantDeleteForAllException extends VKApiException
{
    /**
     * VKApiMessagesCantDeleteForAllException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(924, 'Can\'t delete this message for everybody', $error);
    }
}

