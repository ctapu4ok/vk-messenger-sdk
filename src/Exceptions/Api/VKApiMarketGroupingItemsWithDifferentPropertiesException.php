<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketGroupingItemsWithDifferentPropertiesException extends VKApiException
{
    /**
     * VKApiMarketGroupingItemsWithDifferentPropertiesException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1412, 'Grouping items with different properties', $error);
    }
}

