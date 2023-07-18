<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketShopAlreadyDisabledException extends VKApiException
{
    /**
     * VKApiMarketShopAlreadyDisabledException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1432, 'Market was already disabled in this group', $error);
    }
}

