<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketShopAlreadyEnabledException extends VKApiException
{
    /**
     * VKApiMarketShopAlreadyEnabledException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1431, 'Market was already enabled in this group', $error);
    }
}

