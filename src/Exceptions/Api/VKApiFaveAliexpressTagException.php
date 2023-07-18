<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiFaveAliexpressTagException extends VKApiException
{
    /**
     * VKApiFaveAliexpressTagException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(3800, 'Can\'t set AliExpress tag to this type of object', $error);
    }
}

